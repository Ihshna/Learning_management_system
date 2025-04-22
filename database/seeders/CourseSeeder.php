<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'title' => 'Introduction to Programming',
            'description' => 'Learn the basics of programming using Python.',
        ]);

        Course::create([
            'title' => 'Web Development',
            'description' => 'Front-end and back-end web development basics.',
        ]);

        Course::create([
            'title' => 'Data Science',
            'description' => 'Understand data analysis and machine learning with Python.',
        ]);
    }
}
