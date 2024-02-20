<?php

namespace App\Http\Resources;

use Exception as ExceptionAlias;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array
     * @throws ExceptionAlias
     */
    public function toArray(Request $request): array
    {

//        if (!!empty($this->items)) throw new \Exception('Question by that id is not exist.');;
        return isset($this['items']) ? [
            'data' => $this['items'],
        ] : $this->resource;

        return [
            'tags' => $this['items']
        ];

    }
}
