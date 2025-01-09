<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function speedruns()
    {
        return $this->hasMany(Speedrun::class, 'game_id');
    }


    protected $fillable = [
        'name',
        'description',
        'release_date',
        'developer',
        'image',
    ];
}
