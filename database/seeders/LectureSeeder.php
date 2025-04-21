<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lecture;


class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lecture::create([
            'title' => 'Lecture 1: HTML Basics',
            'video_url' => 'https://www.youtube.com/embed/1Rs2ND1ryYc',
        ]);

        Lecture::create([
            'title' => 'Lecture 2: DBMS Overview',
            'video_url' => 'https://www.youtube.com/embed/ZnALZoUz9oE',
        ]);

        Lecture::create([
            'title' => 'Lecture 3: Web Development',
            'video_url' => 'https://www.youtube.com/embed/1jZ3opKWKRI',
        ]);
    }
}
