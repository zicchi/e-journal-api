<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'photo', 'phone'];
    protected $hidden = ['password'];

    public function schedules()
    {
        return $this->hasMany(TeachingSchedule::class);
    }

    public function notes()
    {
        return $this->hasMany(DailyNote::class);
    }
}
