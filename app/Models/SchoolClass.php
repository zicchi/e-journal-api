<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['name', 'grade_level'];

    public function schedules()
    {
        return $this->hasMany(TeachingSchedule::class);
    }

    public function notes()
    {
        return $this->hasMany(DailyNote::class);
    }
}

