<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speedrun extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_id',
        'game_name',
        'category_id',
        'run_time',
        'video_url',
        'verified_status',
        'date',
        'description',
    ];


    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
