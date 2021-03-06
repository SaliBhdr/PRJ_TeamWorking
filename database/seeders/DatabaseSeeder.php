<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StudyFieldSeeder::class,
            TeacherSeeder::class,
            LessonSeeder::class,
            CourseSeeder::class,
            UserSeeder::class,
            UserCourseSeeder::class,
            GroupSeeder::class,
        ]);
    }
}
