<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'rank',
        'frequency',
        'code',
    ];

    protected $casts = [
        'rank' => 'integer',
        'frequency' => 'integer',
    ];

    public $timestamps = false;
}
