<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyNoteMedia extends Model
{
    protected $fillable = ['daily_note_id', 'type', 'url'];

    public function dailyNote()
    {
        return $this->belongsTo(DailyNote::class);
    }
}
