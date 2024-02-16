<?php

namespace App\Http\Middleware;

use App\Models\UserRequestLog;
use App\Models\UserSettings;
use App\Services\RequestLogService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLogMiddleware
{


    public function __construct(
        public RequestLogService $log
    )
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $userSetting = auth('sanctum')->user()->UserSetting;
        $response = response()->json(['message'=>'You dont have permission to send more requests']);
        if($userSetting->requests_sent < $userSetting->max_requests){
            $response = $next($request);
            UserSettings::where('user_id',auth('sanctum')->user()->id)->increment('requests_sent');
        }

        $this->log
            ->collectData($request,$response->getContent());

       return $response;
    }

}
