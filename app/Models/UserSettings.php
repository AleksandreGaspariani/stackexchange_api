<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;

    protected $table = 'user_settings';

    protected $fillable = [
        'user_id',
        'max_requests',
        'requests_sent'
    ];

    public function hasUser()
    {
        return $this->hasOne(User::class);
    }

}
