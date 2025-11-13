<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stud extends Model
{
    /** @use HasFactory<\Database\Factories\StudFactory> */
    use HasFactory;
  protected $fillable = [
        'name',
        'address',
        'phone',
        'owner_id',
        'amount',
        'description',
    ];

    // dueño del stud 
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // cuidadores que trabajan en este stud 
    public function caretakers()
    {
        return $this->belongsToMany(User::class, 'stud_user')->withTimestamps();
    }

    public function horses()
    {
        return $this->hasMany(Horse::class);
    }
    public function bosses()
{
    return $this->belongsToMany(User::class, 'boss_stud', 'stud_id', 'boss_id');
}
}
