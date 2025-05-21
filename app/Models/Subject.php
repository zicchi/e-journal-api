<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description'];

    public function schedules()
    {
        return $this->hasMany(TeachingSchedule::class);
    }

    public function notes()
    {
        return $this->hasMany(DailyNote::class);
    }
}
