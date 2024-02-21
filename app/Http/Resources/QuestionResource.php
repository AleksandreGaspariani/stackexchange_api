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
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {

        return [
            'user_id' => $this['owner']['user_id'],
            'profile_url' => $this['owner']['link'],
            'tags' => $this['tags'],
            'title' => $this['title'],
        ];

    }
}
