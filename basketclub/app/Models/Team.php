<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    public function games() {
        return $this->hasMany(Game::class);
    }

    public function latestGame() {
        return $this->hasOne(Game::class)->latestOfMany();
    }

    public function players(): BelongsToMany {
        return $this->belongsToMany(Player::class, 'team_player');
    }
}
