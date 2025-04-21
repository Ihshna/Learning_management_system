<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Define the columns that can be mass-assigned
    protected $fillable = ['title', 'date'];
    
    protected $casts = [
        'date' => 'datetime',
    ];
    /**
     * Get the formatted date for the event.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('F j, Y');
    }

    public function lectures()
{
    return $this->hasMany(Lecture::class);
}

     
}
