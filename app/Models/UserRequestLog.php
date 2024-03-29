<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserRequestLog extends Model
{
    use HasFactory;

    protected $table = 'user_request_log';

    protected $fillable = [
        'url',
        'method',
        'user_id',
        'request_body',
        'response_body',
        'headers',
        'passed'
    ];

    protected $casts = [
        'request_body' => 'array',
        'response_body' => 'array',
        'headers' => 'array'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function scopeWhereToday(Builder $query): void
    {
        $query->whereDate('created_at', today());
    }

    public function scopeWherePassed(Builder $query): void
    {
        $query->whereDate('passed', 1);
    }


}
