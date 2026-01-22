<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'games_played',
        'threes_made',
        'doubles_made',
        'free_throws_made',
    ];
    
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
