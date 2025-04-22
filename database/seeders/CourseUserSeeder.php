<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and courses
        $students = User::where('role', 'student')->get(); // Assuming you have a 'role' column to identify students
        $courses = Course::all();

        // Attach students to courses (many-to-many relationship)
        foreach ($students as $student) {
            // Randomly attach 1 to 3 courses to each student
            $student->courses()->attach(
                $courses->random(rand(1, 3))->pluck('id')->toArray()
            );
            }    }
}
