<?php

namespace App\Http\Middleware;

use App\Models\RestApiLog;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RestApiLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate()->id;
        } catch (\Throwable $th) {

        }

        $data = [
            'ip_address'=> $request->ip(),
            'method'    => $request->method(),
            'request'   => $request->all(),
            'endpoint'  => $request->fullUrl(),
            'useragent' => $request->userAgent(),
            'header'    => $request->header(),
            'user_id'   => $user,
        ];
        //dd($data);
        RestApiLog::create($data);
        return $next($request);
    }
}
