<?php

namespace App\Services;

use App\Models\UserRequestLog;
use App\Models\UserSettings;
use Closure;

class RequestLogService
{

    function collectData($request,$response){

        UserRequestLog::create([
            'user_id' => auth('sanctum')->user()->id,
            'url' => $request->url(),
            'method' => $request->method(),
            'request_body' => $request,
            'response_body' => $response,
            'headers' => $request->header()
        ]);

        return response([
            'message' => 'data collected successfully',
        ], 200);
    }

}
