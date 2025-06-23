<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    /** @use HasFactory<\Database\Factories\FoodFactory> */
    use HasFactory;
    protected $fillable = ['horse_id', 'date', 'type_food', 'quantity', 'time', 'notes'];

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }
}
