<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'allergies',
        'injuries',
        'medical_public_id',
        'blood_type',
    ];

    public function player(): BelongsTo {
        return $this->belongsTo(Player::class);
    }
}
