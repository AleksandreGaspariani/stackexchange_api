<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;


class QuestionController extends Controller
{
    public function __construct(
        public ApiService $api
    )
    {

    }

    public function index(){
        $res = $this->api
            ->sendRequest('questions');

        return $res;
    }

    public function show($id){
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
