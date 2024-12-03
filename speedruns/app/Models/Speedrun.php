<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speedrun extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_name',
        'category',
        'run_time',
        'video_url',
        'verified_status',
        'date',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
