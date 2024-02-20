<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Models\User;
use App\Services\ApiService;
use Exception as ExceptionAlias;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;


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
    public function index(): AnonymousResourceCollection
    {

//        $collection = collect([]);
//        $resource = new QuestionResource(User::first());
//        $resources = QuestionResource::collection(User::get());


//        dd();

        $collection = $this->api->sendRequest('questions');

//        return response()->json($collection);

        return QuestionResource::collection($collection);

    }

    /**
     * @throws ExceptionAlias
     */
    public function show($id): QuestionResource
    {

        $resource = $this->api->sendRequest('questions/'.$id);

//        return response()->json($resource);

        return new QuestionResource($resource);

//        $response = new ;

//        if (empty($response['items'])){ throw new \Exception('Question not found or it deleted'); }

//        $userId = $response['owner']['user_id'];

//      UserResource /\

//        return response()->json([
//            'Question' => $response['title'],
//            'Publisher' => $response['owner']['display_name'],
//        ]);

        return new QuestionResource();
    }
}
