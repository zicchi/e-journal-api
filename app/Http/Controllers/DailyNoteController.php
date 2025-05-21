<?php

namespace App\Http\Controllers;

use App\Models\DailyNote;
use App\Models\DailyNoteMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyNoteController extends Controller
{
    public function index(Request $request)
    {
        $query = DailyNote::with(['schoolClass', 'subject', 'media'])
            ->where('teacher_id', $request->user()->id);

        if ($request->has('date')) {
            $query->where('date', $request->date);
        }

        if ($request->has('school_class_id')) {
            $query->where('school_class_id', $request->school_class_id);
        }

        if ($request->has('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $notes = $query->orderBy('date', 'desc')->get();

        return response()->json($notes);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id'      => 'required|exists:subjects,id',
            'date'            => 'required|date',
            'note_text'       => 'nullable|string',
        ]);

        $note = DailyNote::create([
            'teacher_id'      => $request->user()->id,
            'school_class_id' => $validated['school_class_id'],
            'subject_id'      => $validated['subject_id'],
            'date'            => $validated['date'],
            'note_text'       => $validated['note_text'] ?? '',
        ]);

        return response()->json([
            'message' => 'Note created',
            'note'    => $note,
        ], 201);
    }

    public function show($id)
    {
        $note = DailyNote::with(['schoolClass', 'subject', 'media'])->findOrFail($id);
        return response()->json($note);
    }

    public function uploadMedia(Request $request, $id)
    {
        $note = DailyNote::findOrFail($id);

        $request->validate([
            'media' => 'required|file|mimes:jpeg,png,jpg,mp3,m4a,wav|max:20480', // 20MB max
        ]);

        $file = $request->file('media');
        $type = in_array($file->extension(), ['mp3', 'm4a', 'wav']) ? 'audio' : 'image';

        $path = $file->store('note_media', 'public');

        $media = DailyNoteMedia::create([
            'daily_note_id' => $note->id,
            'type'          => $type,
            'url'           => Storage::url($path),
        ]);

        return response()->json([
            'message' => 'Media uploaded',
            'media'   => $media,
        ]);
    }
}
