<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'created_by', 'status'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

