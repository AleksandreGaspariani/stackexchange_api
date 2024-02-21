<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Services\ApiService;
use Exception as ExceptionAlias;
use Illuminate\Http\JsonResponse;


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
    public function index(): JsonResponse
    {

        $response = $this->api->sendRequest('questions');

        $data = $response['items'];

        return response()->json(QuestionResource::collection($data));

    }

    /**
     * @throws ExceptionAlias
     */
    public function show($id): JsonResponse
    {

        $response = $this->api->sendRequest('questions/'.$id);

        if (!isset($response['items'])) {
            throw new \Exception('Item is not isset');
        }

        $data = $response['items'][0];

        return response()->json(new QuestionResource($data));
    }
}
