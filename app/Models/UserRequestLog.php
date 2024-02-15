<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequestLog extends Model
{
    use HasFactory;

    protected $table = 'user_request_log';

    protected $fillable = [
        'user_id',
        'response_body'
    ];

    public function belongUser(){
        return $this->belongsTo(User::class);
    }
}
