<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TeachingScheduleReminder extends Notification
{
    use Queueable;

    public $schedule;

    public function __construct($schedule)
    {
        $this->schedule = $schedule;
    }

    public function via($notifiable)
    {
        return ['database']; // Bisa ditambah 'mail' jika ingin pakai email juga
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => 'Pengingat Jadwal Mengajar',
            'message' => "Anda mengajar {$this->schedule->subject->name} di kelas {$this->schedule->schoolClass->name} pada pukul {$this->schedule->start_time}.",
            'time'    => now()->toDateTimeString(),
            'schedule_id' => $this->schedule->id,
        ];
    }
}

