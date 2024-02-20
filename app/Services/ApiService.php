<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class ApiService
{
    public string $url;
    public string $version;
    public array $params = [];
    public array $baseHeaders = [
        'Access-Control-Request-Method' => 'application/json',
        'content-type' => 'application/json',
    ];
    public function __construct()
    {
        $this->url = config('base.base_url');
        $this->version = config('base.base_version');
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

    /**
     * @throws \Exception
     */
    function sendRequest($endPoint){
        $baseFilter = [
            'site' => 'stackoverflow',
        ];

        $baseFilter = array_merge($baseFilter, $this->params);

        $detailUrl = $this->url.$this->version.$endPoint;

        $res = Http::withHeaders($this->baseHeaders)->get($detailUrl, $baseFilter);

        if($res->successful()){
            return $res->json();
        }elseif ($res->failed()){
            throw new \Exception('API Error.');
        };

    }
}
