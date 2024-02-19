<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserRequestLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RequestLogService
{

    public function collectData($request,$response): JsonResponse
    {

        /** @var User $user */
        $user = Auth::user();

        UserRequestLog::create([
            'user_id' => $user->id,
            'url' => $request->url(),
            'method' => $request->method(),
            'passed' => '1',
            'request_body' => $request,
            'response_body' => $response,
            'headers' => $request->header()
        ]);

        return response()->json([
            'message' => 'data collected successfully',
        ]);
    }

    public static function checkUser(): bool
    {

        /** @var User $user */
        $user = Auth::user();

        $numOfRequestsToday = $user->log()->whereToday()->wherePassed()->count();

        return !($numOfRequestsToday >= $user->settings->max_requests);
    }

}
