<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Race extends Model
{
    /** @use HasFactory<\Database\Factories\RaceFactory> */
    use HasFactory;
    protected $fillable = ['horse_id', 'date', 'place', 'distance', 'description', 'jockey', 'hipodromo', 'video',];

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }
}
