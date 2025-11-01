<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles ;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
];

  public function horsesCaretaker()
{
    return $this->hasMany(Horse::class, 'caretaker_id');
}
public function horsesBoss()
{
    return $this->hasMany(Horse::class, 'boss_id');
}
public function ownedStud()
{
    return $this->hasOne(Stud::class, 'owner_id');
}

public function studs()
{
    return $this->belongsToMany(Stud::class, 'stud_user')->withTimestamps();
}
public function contractedStuds()
{
    return $this->belongsToMany(Stud::class, 'boss_stud', 'boss_id', 'stud_id');
}
public function sendEmailVerificationNotification()
{
    $this->notify(new CustomVerifyEmail);
}


}
