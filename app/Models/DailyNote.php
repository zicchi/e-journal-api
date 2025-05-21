<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyNote extends Model
{
    protected $fillable = [
        'teacher_id', 'school_class_id', 'subject_id', 'date', 'note_text'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function media()
    {
        return $this->hasMany(DailyNoteMedia::class);
    }
}
