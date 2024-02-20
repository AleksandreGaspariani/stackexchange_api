<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Exception as ExceptionAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    public function __construct(
        public ApiService $api
    )
    {

    }

    /**
     * @throws ExceptionAlias
     */
    public function index(){
        return $this->api
            ->sendRequest('questions');
    }

    /**
     * @throws ExceptionAlias
     */
    public function show($id): JsonResponse
    {
        $res = $this->api
            ->sendRequest('questions/'.$id);

        $userId = $res['items'][0]['owner']['user_id'];

        $userInfo = $this->api
            ->sendRequest('users/'.$userId);

        return response()->json([
            'Question Title' => $res['items'][0]['title'],
            'Publisher' => $userInfo['items'][0]['display_name'],
        ]);
    }
}
