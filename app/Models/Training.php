<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Training extends Model
{
    /** @use HasFactory<\Database\Factories\TrainingFactory> */
    use HasFactory;
    protected $fillable = ['horse_id', 'date', 'distance', 'duration_minutes', 'type_training', 'comments'];

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }
    public function getFormattedDurationAttribute()
{
    $minutes = floor($this->duration_minutes);
    $seconds = round(($this->duration_minutes - $minutes) * 60);

    return $minutes > 0 
        ? "{$minutes} min {$seconds} seg"
        : "{$seconds} seg";
}

}
