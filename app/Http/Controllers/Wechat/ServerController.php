<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;

class ServerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('wechat');
    }
    
    public function index(){
        dd(session('wechat.oauth_user'));
    }
    public function token(Request $request){
        \Log::debug('token',$request->all());
        $signature = $request->signature;
        $timestamp = $request->timestamp;
        $nonce = $request->nonce;

        $token = 'cq_youlerou';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return $request->echostr;
        }else{
            return 'false';
        }
    }
}
