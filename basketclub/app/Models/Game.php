<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_home',
        'game_date',
        'pts_team',
        'pts_opponent',
        'team_id',
        'opponent_name'
    ];

    public function team(): BelongsTo {
        return $this->belongsTo(Team::class);
    }
}
