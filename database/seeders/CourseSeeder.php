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
        Course::create([
            'title' => 'Machine Learning',
            'description' => 'Build predictive models and understand core ML algorithms.',
        ]);
    
        // ✅ New Course 2
        Course::create([
            'title' => 'Cybersecurity Fundamentals',
            'description' => 'Learn the principles of protecting networks and data.',
        ]);
    
        // ✅ New Course 3
        Course::create([
            'title' => 'Mobile App Development',
            'description' => 'Create Android and iOS applications using modern frameworks.',
        ]);
    }
    }

