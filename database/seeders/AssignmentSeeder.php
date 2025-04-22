<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Course;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch the first course
        $course = Course::first(); // This will get the first course in your courses table

        // If there are courses, insert assignments
        if ($course) {
            Assignment::create([
                'course_id' => $course->id, // Associating with the first course
                'title' => 'Assignment 1',
                'description' => 'Complete the basic programming task.',
                'due_date' => '2025-05-15',
            ]);

            Assignment::create([
                'course_id' => $course->id,
                'title' => 'Assignment 2',
                'description' => 'Prepare a report on the recent lecture.',
                'due_date' => '2025-05-20',
            ]);
        }
}
}