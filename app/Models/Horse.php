<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Horse extends Model
{
    /** @use HasFactory<\Database\Factories\HorseFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'breed',
        'color',
        'birth_date',
        'gender',
        'father_name',
        'mother_name',
        'photo_path',
        'number_microchip',
        'boss_id',
        'caretaker_id',
    ];
   

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class);
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function races(): HasMany
    {
        return $this->hasMany(Race::class);
    }

    public function vetVisits(): HasMany
    {
        return $this->hasMany(VetVisit::class);
    }

    public function calendarEvents(): HasMany
    {
        return $this->hasMany(CalendarEvent::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
    
public function photos()
{
    return $this->hasMany(HorsePhoto::class);
}

 public function blacksmiths(): HasMany
 {
        return $this->hasMany(Blacksmith::class);
}
public function boss()
{
    return $this->belongsTo(User::class, 'boss_id');
}
public function caretaker()
{
    return $this->belongsTo(User::class, 'caretaker_id');
}


}
