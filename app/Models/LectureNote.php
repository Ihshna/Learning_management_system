<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LectureNote extends Model
{
    protected $fillable = ['course_id', 'lecture_number', 'title', 'file_path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
