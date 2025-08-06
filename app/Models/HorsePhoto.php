<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorsePhoto extends Model
{
    /** @use HasFactory<\Database\Factories\HorsePhotoFactory> */
    use HasFactory;
     protected $fillable = ['horse_id', 'path'];

    public function horse()
    {
        return $this->belongsTo(Horse::class);
    }
}
