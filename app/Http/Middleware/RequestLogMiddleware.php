<?php

namespace App\Http\Middleware;

use App\Models\UserRequestLog;
use App\Models\UserSettings;
use App\Services\RequestLogService;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (!RequestLogService::checkUser()) /* @param \Boolean */
        {
            $response = response()->json(['message'=>'You dont have permission to send more requests']);
        }else {
            $response = $next($request);
        }

        $this->log->collectData($request,$response->getContent());

        return $response;
    }

}
