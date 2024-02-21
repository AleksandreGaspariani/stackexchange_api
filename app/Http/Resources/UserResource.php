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
            'total_questions' => $this->when(isset($this['total_questions']),$this['total_questions']),
            'total_answers' => $this->when(isset($this['total_answers']),$this['total_answers'])
        ];

        return $output;
    }

}
