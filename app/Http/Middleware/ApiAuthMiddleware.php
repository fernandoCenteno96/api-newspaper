<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthMiddleware
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
        $token=$request->header('authorization');
        $jwtAuth=new \app\helpers\jwtAuth;
        $checktoken=$jwtAuth->checkToken($token);
        if($checktoken){
            return $next($request);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'el usuario no esta identificado correctamente',
                'code'=>'404'
            ],404);
        }
        
    }
}
