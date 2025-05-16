<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
protected $fillable = [
    'student_id',
        'course_id',
        'payment_slip',
        'status',
];
// app/Models/Payment.php

public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}

public function course()
{
    return $this->belongsTo(Course::class);
}

}
