<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable=['title','code','description','status','created_by'];

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
//course count to SuperAdmin dashboard
    public function students()
{
    return $this->belongsToMany(User::class, 'course_student', 'course_id', 'student_id');
}

}
