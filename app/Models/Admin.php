<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins'; // Only needed if table name isn't the plural of model
    protected $fillable = ['name', 'email', 'password']; // Add other fields if needed
}

