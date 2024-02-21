<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\ApiService;
use App\Services\RequestLogService;
use Exception;
use Illuminate\Http\JsonResponse;

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
    public function index(): JsonResponse
    {

        $response = $this->api
            ->addParam(['order' => 'desc'])
            ->sendRequest('users');

        $data = $response['items'];

        return response()->json(UserResource::collection($data));
    }

    /**
     * Display the specified resource.
     * @throws Exception
     */
    public function show(string $id): JsonResponse
    {
        $user = $this->api
            ->sendRequest('users/'.$id);

        if (empty($user['items'])){
            throw new \Exception('UserCollection not found');
        }

        $questions = $this->api
            ->addParam(['filter' => 'total'])
            ->sendRequest('users/' .$id . '/questions');

        $answers = $this->api
            ->addParam(['filter' => 'total'])
            ->sendRequest('users/'.$id.'/answers');

        $data = array_merge($user['items'][0],['total_questions' => $questions['total'],'total_answers' => $answers['total']]);

        return response()->json(new UserResource($data));

    }
}
