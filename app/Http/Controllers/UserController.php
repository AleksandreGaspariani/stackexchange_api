<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->sendRequest(['order' => 'desc'],'users');
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
        $user = $this->sendRequest([],'users/'.$id);

        $questions = $this->sendRequest(['filter'=>'total'],'users/' .$id . '/questions');

        $answers = $this->sendRequest(['filter'=>'total'],'users/'.$id.'/answers');

        // dd($answers->json());
        return response()->json([
            'Username' => $user['items'][0]['display_name'],
            'Total Answers'=> $answers['total'],
            'Total Quetions'=> $questions['total'],
        ]);
        

    }

    public function sendRequest($filters,$param){
        config('api.base_url');
        $baseUrl = 'https://api.stackexchange.com/';
        $baseVersion = '2.3/';
        $baseHeaders = [
            'Access-Control-Request-Method' => 'application/json',
            'content-type' => 'application/json',
        ];

        $baseFilter = [
            'site' => 'stackoverflow',
        ];

        $baseFilter = array_merge($baseFilter, $filters);

        // $baseFilter['leqso'] = 'rame';
        // $newArray = ['axali' => 2]; 
        // $baseFilter += $newArray;
        

            $detailUrl = $baseUrl.$baseVersion.$param;
            $res = Http::withHeaders($baseHeaders)->get($detailUrl, $baseFilter);
            return $res->json();
        
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
