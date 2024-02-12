<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{


    public function __construct(
        public ApiService $api
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->api
            ->addParam(['order' => 'desc'])
            ->sendRequest('users');
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->api
            ->sendRequest('users/'.$id);

        $questions = $this->api
            ->addParam(['filter' => 'total'])
            ->sendRequest('users/' .$id . '/questions');

        $answers = $this->api
            ->addParam(['filter' => 'total'])
            ->sendRequest('users/'.$id.'/answers');

        // dd($answers->json());
        return response()->json([
            'Username' => $user['items'][0]['display_name'],
            'Total Answers'=> $answers['total'],
            'Total Quetions'=> $questions['total'],
        ]);


    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
