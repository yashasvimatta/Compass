<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id'];

    // Define a relationship with the User model for the student
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define a relationship with the Course model
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
