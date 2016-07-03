<?php

namespace App\Http\Middleware;

use Closure;
use Wechat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Socialite;

/**
 * Class WechatAuthenticate
 */
class WechatAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            if ($request->has('state') && $request->has('code')) {
                $wechat_user=Wechat::oauth()->user();
                $user=Socialite::find($wechat_user->getId());
                if($user){
                    Auth::login($user->user());
                }else{
                    $original=$wechat_user->getOriginal();
                    $user=new User();
                    $user->name='SJ'.date('YmdHis').rand(10000,99999);
                    $user->email=$user->name.'@sj.com';
                    $user->password=rand(10000,99999);
                    $user->save();
                    $socialite=new Socialite();
                    $socialite->user_id = $user->user_id;
                    $socialite->openid = $original->openid;
                    $socialite->nickname = $original->nickname;
                    $socialite->sex = $original->sex;
                    $socialite->province = $original->province;
                    $socialite->city = $original->city;
                    $socialite->country = $original->country;
                    $socialite->headimgurl = $original->headimgurl;
                    $socialite->privilege = $original->privilege;
                    $socialite->save();
                    Auth::login($user->user());
                }
                return redirect()->to($this->getTargetUrl($request));
            }

            $scopes = config('wechat.oauth.scopes', ['snsapi_base']);

            if (is_string($scopes)) {
                $scopes = array_map('trim', explode(',', $scopes));
            }

            return Wechat::oauth()->scopes($scopes)->redirect($request->fullUrl());
        }

        return $next($request);
    }

//    public function handle($request, Closure $next, $guard = null)
//    {
//        if (!session('wechat.oauth_user')) {
//            if ($request->has('state') && $request->has('code')) {
//                session(['wechat.oauth_user' => Wechat::oauth()->user()]);
//
//                return redirect()->to($this->getTargetUrl($request));
//            }
//
//            $scopes = config('wechat.oauth.scopes', ['snsapi_base']);
//
//            if (is_string($scopes)) {
//                $scopes = array_map('trim', explode(',', $scopes));
//            }
//
//            return Wechat::oauth()->scopes($scopes)->redirect($request->fullUrl());
//        }
//
//        return $next($request);
//    }

    /**
     * Build the target business url.
     *
     * @param Request $request
     *
     * @return string
     */
    public function getTargetUrl($request)
    {
        $queries = array_except($request->query(), ['code', 'state']);

        return $request->url() . (empty($queries) ? '' : '?' . http_build_query($queries));
    }
}
