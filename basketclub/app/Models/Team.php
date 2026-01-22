<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    public function coachers(): BelongsToMany {
        return $this->belongsToMany(Coacher::class, 'coacher_team')
            ->withPivot('start_date', 'end_date')
            ->withTimestamps();
    }

        public function image(): MorphOne {
        return $this->morphOne(Image::class, 'imageable');
    }

        protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }
}
