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
        'started_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
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

    public function getHighestUser()
    {
        return $this->users()->orderBy('current_code_id', 'desc')->first();
    }

    public function getHighestCode()
    {
        return $this->getHighestUser()->currentCode;
    }

    public function getPastCodes(int $limit)
    {
        return Code::where('id', '<', $this->getHighestCode()->id)
        ->orderBy('id', 'desc')
        ->limit($limit)
        ->get()
        ->reverse();
    }

    public function getFutureCodes(int $limit)
    {
        return Code::where('id', '>', $this->getHighestCode()->id)
        ->orderBy('id', 'asc')
        ->limit($limit)
        ->get();
    }

}
