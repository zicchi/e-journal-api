<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\TeachingSchedule;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate all tables to avoid duplication
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Teacher::truncate();
        SchoolClass::truncate();
        Subject::truncate();
        TeachingSchedule::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed Teachers
        Teacher::insert([
            ['name' => 'Ina Hasanah', 'email' => 'ratna26@ud.int', 'password' => Hash::make('password'), 'phone' => '+62 (0054) 052-0273'],
            ['name' => 'Maryadi Handayani, S.Farm', 'email' => 'ftampubolon@hotmail.com', 'password' => Hash::make('password'), 'phone' => '+62 (076) 254 4276'],
            ['name' => 'Emong Usamah', 'email' => 'hgunawan@hotmail.com', 'password' => Hash::make('password'), 'phone' => '+62 (057) 658 3524'],
            ['name' => 'Warji Lazuardi, S.E.I', 'email' => 'banawisitorus@perum.biz.id', 'password' => Hash::make('password'), 'phone' => '0867462839'],
            ['name' => 'Danuja Pradipta', 'email' => 'dasawidodo@yahoo.com', 'password' => Hash::make('password'), 'phone' => '+62 (0583) 312-2999'],
        ]);

        // Seed Classes
        SchoolClass::insert([
            ['name' => 'X-A', 'grade_level' => '10'],
            ['name' => 'X-B', 'grade_level' => '10'],
            ['name' => 'X-C', 'grade_level' => '10'],
        ]);

        // Seed Subjects
        Subject::insert([
            ['name' => 'Matematika', 'description' => 'Pelajaran berhitung'],
            ['name' => 'Bahasa Indonesia', 'description' => 'Pelajaran kebahasaan'],
            ['name' => 'Fisika', 'description' => 'Ilmu fisika dasar'],
        ]);

        // Seed Teaching Schedules
        TeachingSchedule::insert([
            ['teacher_id' => 4, 'school_class_id' => 2, 'subject_id' => 1, 'day' => 'Jumat', 'start_time' => '07:00:00', 'end_time' => '08:30:00'],
            ['teacher_id' => 5, 'school_class_id' => 3, 'subject_id' => 2, 'day' => 'Rabu', 'start_time' => '07:00:00', 'end_time' => '08:30:00'],
            ['teacher_id' => 1, 'school_class_id' => 3, 'subject_id' => 3, 'day' => 'Rabu', 'start_time' => '07:00:00', 'end_time' => '08:30:00'],
            ['teacher_id' => 3, 'school_class_id' => 2, 'subject_id' => 1, 'day' => 'Selasa', 'start_time' => '07:00:00', 'end_time' => '08:30:00'],
            ['teacher_id' => 1, 'school_class_id' => 1, 'subject_id' => 1, 'day' => 'Senin', 'start_time' => '07:00:00', 'end_time' => '08:30:00'],
        ]);
    }
}
