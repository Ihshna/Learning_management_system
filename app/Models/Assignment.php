<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'description',
        'due_date',
        'course_id',
        'file_path',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

     // 🔥 Add this new relationship
     public function submissions()
     {
         return $this->hasMany(AssignmentSubmission::class);
     }
}
