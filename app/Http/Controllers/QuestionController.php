<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionCollection;
use App\Services\ApiService;
use Exception as ExceptionAlias;


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
    public function index(): QuestionCollection
    {
        return new QuestionCollection([
           $this->api
            ->sendRequest('questions')
        ]);
    }

    /**
     * @throws ExceptionAlias
     */
    public function show($id): QuestionCollection
    {
        $res = $this->api
            ->sendRequest('questions/'.$id);

        if (empty($res['items'])){ throw new \Exception('Question not found or it deleted'); }

        $userId = $res['items'][0]['owner']['user_id'];

        $userInfo = $this->api
            ->sendRequest('users/'.$userId);

        return new QuestionCollection([
            'Question' => $res['items'][0]['title'],
            'Publisher' => $userInfo['items'][0]['display_name'],
        ]);
    }
}
