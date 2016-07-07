<?php

namespace App\Http\Controllers\Home;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;
use App\Models\WebConfig;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $config=[];

    public function __construct()
    {
        $this->config=$this->getConfig();
        view()->share('config',$this->config);
    }

    protected function getConfig()
    {
        if(!Cache::store('file')->has('web_config')){
            $arr=[];
            $configs=WebConfig::where('parent_id','<>',0)->get();
            foreach ($configs as $config) {
                $arr[$config->code]=$config->value;
            }
            Cache::store('file')->put('web_config',$arr,60);
            return $arr;
        }else{
            return Cache::store('file')->get('web_config');
        }
    }
}

