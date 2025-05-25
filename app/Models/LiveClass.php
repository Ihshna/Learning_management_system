<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{
    use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'meeting_link',
    'start_time',
    'end_time',
    'course_id',
];
protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Optional relationship (if each live class belongs to a course)
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
