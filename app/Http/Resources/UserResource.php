<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $output = [
            'badge_counts' => $this['badge_counts'],
            'account_id' => $this['account_id'],
            'display_name' => $this['display_name'],
        ];

        if (isset($this['total_questions'])){
            $output['total_questions'] = $this['total_questions'];
        }

        if (isset($this['total_answers'])){
            $output['total_answers'] = $this['total_answers'];
        }

        return $output;
    }

}
