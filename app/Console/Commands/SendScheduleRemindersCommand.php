<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TeachingSchedule;
use Carbon\Carbon;
use App\Notifications\TeachingScheduleReminder;

class SendScheduleRemindersCommand extends Command
{
    protected $signature = 'reminder:schedule';
    protected $description = 'Kirim pengingat ke guru 30 menit sebelum jam mengajar';

    public function handle()
    {
        $now = Carbon::now();
        $day = $now->locale('id')->isoFormat('dddd'); // e.g. 'Senin', 'Selasa'
        $targetTime = $now->addMinutes(30)->format('H:i:s');

        $schedules = TeachingSchedule::with(['teacher', 'subject', 'schoolClass'])
            ->where('day', ucfirst($day))
            ->where('start_time', $targetTime)
            ->get();

        foreach ($schedules as $schedule) {
            $schedule->teacher->notify(new TeachingScheduleReminder($schedule));
        }

        $this->info("Reminder dikirim untuk jadwal jam {$targetTime}");
    }
}
