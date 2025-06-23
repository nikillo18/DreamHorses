<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalendarEvent extends Model
{
    /** @use HasFactory<\Database\Factories\CalendarEventFactory> */
    use HasFactory;
    protected $fillable = ['horse_id', 'title', 'description', 'event_date', 'event_time', 'category'];

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }
}
