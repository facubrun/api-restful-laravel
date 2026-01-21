<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // protected $hidden = ['imageable_type', 'imageable_id', 'created_at', 'updated_at'];
    protected $visible = ['id', 'url']; // opuesto a hidden

    public function imageable()
    {
        return $this->morphTo();
    }
}
