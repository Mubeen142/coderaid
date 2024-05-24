<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RaidSession extends Model
{
    use HasFactory;

    protected $table = 'raid_sessions';

    protected $fillable = [
        'token',
        'name',
        'server',
        'location',
        'master_code_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($session) {
            $session->token = Str::random(32);
        });
    }

    public function users()
    {
        return $this->hasMany(SessionUser::class, 'raid_session_id', 'id');
    }
}
