<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
    use HasFactory;

    protected $table = 'raid_sessions_users';

    protected $fillable = [
        'raid_session_id',
        'nickname',
        'current_code_id',
        'total_guess_count',
        'ip_address',
    ];
}