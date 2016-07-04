<?php

namespace App\Http\Controllers\Admin\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;

class ServerController extends Controller
{
    //
    public function __construct()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') === false) {
            $this->middleware('auth');
        } else {
            $this->middleware('wechat');
        }
    }

    public function index()
    {
//        $original = [
//            "openid" => "oVWc5xIPC1BK4Nhj1M4eEGcBVCHg",
//            "nickname" => "霖",
//            "sex" => 1,
//            "language" => "zh_CN",
//            "city" => "汕头",
//            "province" => "广东",
//            "country" => "中国",
//            "headimgurl" => "http://wx.qlogo.cn/mmopen/05iayxiaJMoGI0XHSmRSv28cNqibb9YJe7UIXfH7WvGLO6dHsNhgl655ibRzcVXr6VAVUH2vJNh4YByibyiblQPVHxB7B3VFhu94Wic/0"
//        ];
//        $socialite=new \App\Models\Socialite();
//        $socialite->user_id = 10;
//        $socialite->openid = $original['openid'];
//        $socialite->nickname = $original['nickname'];
//        $socialite->sex = $original['sex'];
//        $socialite->province = $original['province'];
//        $socialite->city = $original['city'];
//        $socialite->country = $original['country'];
//        $socialite->headimgurl = $original['headimgurl'];
//        $socialite->save();
        dd([\Auth::user(),\Auth::user()->socialites]);
    }

    public function token(Request $request)
    {
        \Log::debug('token', $request->all());
        $signature = $request->signature;
        $timestamp = $request->timestamp;
        $nonce = $request->nonce;

        $token = 'cq_youlerou';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return $request->echostr;
        } else {
            return 'false';
        }
    }
}
