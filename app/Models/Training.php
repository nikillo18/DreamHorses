<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Training extends Model
{
    /** @use HasFactory<\Database\Factories\TrainingFactory> */
    use HasFactory;
    protected $fillable = ['horse_id', 'date', 'distance', 'duration_minutes', 'comments'];

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }
}
