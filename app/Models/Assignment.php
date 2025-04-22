<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Assignment;


class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'course_id'];

    // ✅ Relationship to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
