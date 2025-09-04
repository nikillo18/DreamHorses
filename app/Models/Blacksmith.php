<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blacksmith extends Model
{
    /** @use HasFactory<\Database\Factories\BlacksmithFactory> */
    use HasFactory;
    protected $fillable = ['horse_id', 'date', 'name', 'horseshoe'];
    public function horse()
    {
        return $this->belongsTo(Horse::class);
    }
}
