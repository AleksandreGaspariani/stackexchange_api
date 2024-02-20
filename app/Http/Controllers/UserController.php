<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Services\ApiService;
use App\Services\RequestLogService;
use Exception;

class UserController extends Controller
{


    public function __construct(
        public ApiService $api,
        public RequestLogService $log
    )
    {

    }

    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index(): UserCollection
    {

        $response = $this->api
            ->addParam(['order' => 'desc'])
            ->sendRequest('users');

        return new UserCollection($response);
    }

    /**
     * Display the specified resource.
     * @throws Exception
     */
    public function show(string $id): UserCollection
    {
        $user = $this->api
            ->sendRequest('users/'.$id);

        if (empty($user['items'])){
            throw new \Exception('UserCollection not found');
        };

        $questions = $this->api
            ->addParam(['filter' => 'total'])
            ->sendRequest('users/' .$id . '/questions');

        $answers = $this->api
            ->addParam(['filter' => 'total'])
            ->sendRequest('users/'.$id.'/answers');

        return new UserCollection([
            'UserCollection' => $user['items'][0]['display_name'],
            'Total Answers' => $answers['total'],
            'Total Questions' => $questions['total']
        ]);

    }
}
