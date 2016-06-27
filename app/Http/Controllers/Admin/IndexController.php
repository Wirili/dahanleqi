<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function welcome()
    {
        $ver_info = gd_info();
        preg_match('/\d/', $ver_info['GD Version'], $match);
        $gd = $match[0];
        $sys_info['os']=PHP_OS ;
        //$sys_info['ip'] = $_SERVER['SERVER_ADDR'];
        $sys_info['web_server'] = $_SERVER['SERVER_SOFTWARE'];
        $sys_info['php_ver'] = PHP_VERSION;

        //$sys_info['mysql_ver'] =  mysql_get_server_info($conn);
        $sys_info['zlib'] = function_exists('gzclose') ? trans('sys.yes') : trans('sys.no');
        $sys_info['safe_mode'] = (boolean) ini_get('safe_mode') ? trans('sys.yes') : trans('sys.no');
        $sys_info['safe_mode_gid'] = (boolean) ini_get('safe_mode_gid') ? trans('sys.yes') : trans('sys.no');
        $sys_info['timezone'] = function_exists("date_default_timezone_get") ? date_default_timezone_get() : trans('sys.no_timezone');
        $sys_info['socket'] = function_exists('fsockopen') ? trans('sys.yes') : trans('sys.no');

        if ($gd == 0) {
            $sys_info['gd'] = 'N/A';
        } else {
            if ($gd == 1) {
                $sys_info['gd'] = 'GD1';
            } else {
                $sys_info['gd'] = 'GD2';
            }

            $sys_info['gd'] .= ' (';

            /* 检查系统支持的图片类型 */
            if ($gd && (imagetypes() & IMG_JPG) > 0) {
                $sys_info['gd'] .= ' JPEG';
            }

            if ($gd && (imagetypes() & IMG_GIF) > 0) {
                $sys_info['gd'] .= ' GIF';
            }

            if ($gd && (imagetypes() & IMG_PNG) > 0) {
                $sys_info['gd'] .= ' PNG';
            }

            $sys_info['gd'] .= ')';
        }

        /* 允许上传的最大文件大小 */
        $sys_info['max_filesize'] = ini_get('upload_max_filesize');

        return view('admin.welcome',['sys_info'=>$sys_info]);
    }

    public function getSetting(){
        return view('admin.setting');
    }

    public function postSetting(){
        return view('admin.setting');
    }
}
