<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    // Relationship with User
    public function students()
{
    return $this->belongsToMany(User::class, 'course_user'); // Same pivot table name as in the User model
}

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    
}
