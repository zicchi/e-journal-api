<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeachingSchedule;

class TeachingScheduleController extends Controller
{
    public function index(Request $request)
    {
        $teacherId = $request->user()->id;

        $schedules = TeachingSchedule::with(['schoolClass', 'subject'])
            ->where('teacher_id', $teacherId)
            ->orderByRaw("FIELD(day, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
            ->orderBy('start_time')
            ->get();

        return response()->json($schedules);
    }
}

