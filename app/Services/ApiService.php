<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class ApiService
{
    public string $url;
    public array $params = [];
    public array $baseHeaders = [
        'Access-Control-Request-Method' => 'application/json',
        'content-type' => 'application/json',
    ];
    public function __construct()
    {
        $this->url = config('base.base_url');
    }

    public function addParam($param){
        $this->params = array_merge($this->params, $param);
        return $this;
    }

    public function addHeader($key, $value)
    {
        $this->baseHeaders[$key] = $value;
        return $this;
    }

    function sendRequest($endPoint){
        $baseFilter = [
            'site' => 'stackoverflow',
        ];

        $baseFilter = array_merge($baseFilter, $this->params);

        $detailUrl = $this->url.config('base.base_version').$endPoint;

        $res = Http::withHeaders($this->baseHeaders)->get($detailUrl, $baseFilter);
        return $res->json();

    }
}
