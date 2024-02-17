<?php

namespace App\Services;

use App\Models\UserRequestLog;
use App\Models\UserSettings;
use Closure;
use Illuminate\Support\Facades\Auth;

class RequestLogService
{

    public function collectData($request,$response){

        UserRequestLog::create([
            'user_id' => Auth::user()->id,
            'url' => $request->url(),
            'method' => $request->method(),
            'passed' => '1',
            'request_body' => $request,
            'response_body' => $response,
            'headers' => $request->header()
        ]);

        return response([
            'message' => 'data collected successfully',
        ], 200);
    }

    public static function checkUser(){

        $user = Auth::user();

        $numOfRequestsToday = $user->UserRequestLog()->where('created_at','>',today())->where('passed',1)->count();

        $numOfRequestsToday >= $user->UserSetting()->max_requests ? $permission = false : $permission = true;

        return $permission;
    }

}
