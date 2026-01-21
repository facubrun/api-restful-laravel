<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Player extends Model
{
    use HasFactory;

    public function medicalRecord(): HasOne
    {
        return $this->hasOne(MedicalRecord::class);
    }

    public function teams(): BelongsToMany {
        return $this->belongsToMany(Team::class, 'team_player');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}