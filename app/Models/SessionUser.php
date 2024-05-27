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
        'avatar',
        'confetti',
        'started_at',
    ];

    protected $casts = [
        'total_guess_count' => 'integer',
        'started_at' => 'datetime',
        'confetti' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->avatar = "assets/img/avatars/AV" . rand(1, 50) . ".png";
        });
    }

    // when retrieving the avatar, we want to make sure it's always a full URL
    public function getAvatarAttribute($value)
    {
        return asset($value);
    }

    public function currentCode()
    {
        return $this->belongsTo(Code::class, 'current_code_id');
    }

    public function confettiLaunched()
    {
        $this->update([
            'confetti' => true,
        ]);
    }
}
