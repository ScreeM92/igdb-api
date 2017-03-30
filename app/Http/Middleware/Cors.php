<?php

namespace App\Http\Middleware;

use Closure;

class Cors {
    public function handle($request, Closure $next)
    {
        // return $next($request)
        //     ->header('Access-Control-Allow-Origin', '*')
        //     ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        //     ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With');
        //     
        

        //$response= $next($request);  
        $allow_origin = [
            'http://igdb.local'
        ];

        if(isset($_SERVER['HTTP_ORIGIN']) &&
            in_array($_SERVER['HTTP_ORIGIN'], $allow_origin)) {

            //配置信任的跨域来源
            // header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            // 
        	header("Access-Control-Allow-Origin: *");
        	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            //配置允许发送认证信息 比如cookies（会话机制的前提）
            header('Access-Control-Allow-Credentials: true');
            //允许的自定义请求头
            header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With');
            //信任跨域有效期，秒为单位
            //header('Access-Control-Max-Age: 120');
        }

        //return $response;
        return $next($request); 
    }
}