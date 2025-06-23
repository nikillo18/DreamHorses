<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caretaker extends Model
{
    /** @use HasFactory<\Database\Factories\CaretakerFactory> */
    use HasFactory;
    protected $fillable = ['name', 'phone', 'address'];

    public function horses(): HasMany
    {
        return $this->hasMany(Horse::class);
    }
}
