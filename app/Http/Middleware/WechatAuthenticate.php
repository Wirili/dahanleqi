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
                $wechat_user = Wechat::oauth()->user();
                $user = Socialite::where('openid',$wechat_user->getId())->first();
                if (!$user && $wechat_user->getToken()->scope == 'snsapi_base') {
                    return Wechat::oauth()->scopes(['snsapi_userinfo'])->redirect($request->fullUrl());
                } elseif ($user) {
                    Auth::login($user->user);
                } else {
                    $original = $wechat_user->getOriginal();
                    $subscribe = Wechat::user()->get($original['openid']);
                    Wechat::user();
                    $user = new User();
                    $user->name = $original['nickname'];
                    $user->email = 'SJ' . date('YmdHis') . rand(10000, 99999) . '@sj.com';
                    $user->password = \Hash::make(rand(10000, 99999));
                    $user->save();
                    $socialite = new Socialite();
                    $socialite->user_id = $user->user_id;
                    $socialite->openid = $original['openid'];
                    $socialite->nickname = $original['nickname'];
                    $socialite->sex = $original['sex'];
                    $socialite->language = $original['language'];
                    $socialite->province = $original['province'];
                    $socialite->city = $original['city'];
                    $socialite->country = $original['country'];
                    $socialite->headimgurl = $original['headimgurl'];
                    $socialite->unionid = $original['unionid']??'';
                    $socialite->subscribe = $subscribe->subscribe;
                    $socialite->subscribe_time = $subscribe->subscribe_time??0;
                    $socialite->save();
                    Auth::login($user);
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
