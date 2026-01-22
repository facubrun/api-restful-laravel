<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'nationality',
        'years_experience',
    ];

    protected $casts = [
        'birth_date' => 'date:Y-m-d',
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'coacher_team')
            ->withPivot('start_date', 'end_date')
            ->withTimestamps();
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }
}
