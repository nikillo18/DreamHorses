<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;
    protected $fillable = ['horse_id', 'date', 'category', 'description', 'amount'];

    public function horse(): BelongsTo
    {
        return $this->belongsTo(Horse::class);
    }
}
