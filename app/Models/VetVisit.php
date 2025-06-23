<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VetVisit extends Model
{
    /** @use HasFactory<\Database\Factories\VetVisitFactory> */
    use HasFactory;
    protected $fillable = ['horse_id', 'visit_date', 'vet_name', 'vet_phone', 'diagnosis', 'treatment', 'next_visit'];

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }
}
