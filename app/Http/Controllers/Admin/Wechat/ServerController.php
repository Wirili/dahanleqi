<?php

namespace App\Http\Controllers\Admin\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;

class ServerController extends Controller
{
    //
    public function __construct()
    {
//        $user_agent = $_SERVER['HTTP_USER_AGENT'];
//        if (strpos($user_agent, 'MicroMessenger') === false) {
//            $this->middleware('auth');
//        } else {
//            $this->middleware('wechat');
//        }
    }

    public function index(Request $request)
    {
        if($request->isMethod('GET'))
            return $this->token($request);
        else
            return $this->server($request);
        
    }

    protected function token(Request $request)
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
    
    protected function server(Request $request)
    {
        $server=\Wechat::server();
        $server->setMessageHandler(function($message){
            \Log::debug('message', $message->all());
            switch($message->MsgType){
                case 'event':
                    return 'event';
                    break;
                case 'text':
                    return '你好！欢迎关注我';
                    break;
            }
        });
        return $server->serve();
    }
}
