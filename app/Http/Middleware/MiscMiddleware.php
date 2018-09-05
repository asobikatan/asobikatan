<?php

namespace App\Http\Middleware;

use Closure;

class MiscMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->merge(['isAndroid' => false]);
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if( (strpos($ua,'iPhone') !== false) || (strpos($ua,'iPod') !== false) || (strpos($ua,'iPad') !== false)) {
            $ua_override = 'sp';   //  スマホ版テンプレを利用
        }elseif(strpos($ua,'Android') !== false){
            $ua_override = 'sp';   //  スマホ版テンプレを利用
            $request->isAndroid = true;
        }else{
            $ua_override = 'jp';   // PC版テンプレを利用
        }

        if(isset($request->ua)){
            session(['session_ua' => $request->ua]);
            if($request->ua == 'reset'){
                session(['session_ua' => '']);
            }
        }
        if(strlen(session('session_ua')) > 0){
            $ua_override = session('session_ua');
        }

        if($ua_override == 'sp'){
            $request->merge(['ua' => 'sp_']);   // スマホ版テンプレを利用
        }elseif($ua_override == 'ja'){
            $request->merge(['ua' => '']);   // PC版テンプレを利用
        }
        return $next($request);
    }
}
