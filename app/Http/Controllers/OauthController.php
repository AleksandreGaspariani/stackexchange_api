<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Exception as ExceptionAlias;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;


class OauthController extends Controller
{

    public function __construct(
        public ApiService $api,
    )
    {

    }

    /**
     * @throws ExceptionAlias
     */
    public function getCode()
    {

        return redirect('https://stackoverflow.com/oauth?client_id=28322&redirect_uri=http://localhost:8000/api/test',302,[
            'accept' => 'application/json'
        ]);

//        return Http::get('https://stackoverflow.com/oauth',[
//            'client_id' => 28322,
////            'scope' => '',
//            'redirect_uri' => 'http://localhost:8000/api/test',
////            'options' => ''
//        ]);

//        https://stackoverflow.com/oauth?client_id=28322&redirect_uri=http://localhost:8000/api/test
//        fEx1Ul5urOl*Wf99(2rvpw))
    }

    public function test(Request $request)
    {
        return $request['code'];

//        return redirect('https://stackoverflow.com/oauth/access_token?client_id=28322&client_secret=')
    }
}
