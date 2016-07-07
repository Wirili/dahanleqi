<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use Wechat, Log;

class WechatController extends Controller
{
    //
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
