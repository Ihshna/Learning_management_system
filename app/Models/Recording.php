<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
    use HasFactory;

    protected $table = 'lecture_recordings'; // ✅ specify custom table name

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'file_path',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
