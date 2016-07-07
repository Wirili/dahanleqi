<?php

namespace App\Http\Controllers\Home;

use App\models\Socialite;
use Illuminate\Http\Request;

use App\Http\Requests;
use Wechat, Log;

class WechatController extends Controller
{
    //
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        if ($request->isMethod('GET'))
            return $this->token($request);
        else
            return $this->server($request);

    }

    protected function token(Request $request)
    {
        Log::debug('token', $request->all());
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

    protected function server(Request $request)
    {
        $server = Wechat::server();
        $server->setMessageHandler(function ($message) {
            Log::debug('message', $message->all());
            switch ($message->MsgType) {
                case 'event':
                    switch($message->Event){
                        case 'subscribe':
                            return $this->subscribe($message);
                        case 'unsubscribe':
                            return $this->unsubscribe($message);
                    }
                    return 'event';
                case 'text':
                    return '你好！欢迎关注我';
            }
        });
        return $server->serve();
    }

    protected function subscribe($message)
    {
        $socialite=Socialite::where('openid',$message->FromUserName)->first();
        if($socialite){
            $socialite->subscribe=1;
            $socialite->save();
        }
        return '欢迎关注优乐柔！';
    }

    protected function unsubscribe($message)
    {
        $socialite=Socialite::where('openid',$message->FromUserName)->first();
        if($socialite){
            $socialite->subscribe=0;
            $socialite->save();
        }
        return '取消关注优乐柔！';
    }
}
