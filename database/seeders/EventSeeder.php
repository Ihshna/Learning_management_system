<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'title' => 'Web Development Workshop',
            'date' => '2025-04-22',
        ]);

        // Second Event
        Event::create([
    'title' => 'AI Seminar',
    'date' => '2025-04-25',
]);

// Third Event
        Event::create([
    'title' => 'Database Project Submission',
    'date' => '2025-04-28',
]);
    }
}
