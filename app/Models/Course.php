<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'course_id',
        'user_id',
        'branch_name',
        'department_code',
        'course_code',
        'course_name',
        'assigned_guide_name',
        'course_desc',
    ];
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Define a relationship with the CourseEnrollment model for enrolled students
    public function enrolledStudents()
    {
        return $this->hasMany(CourseEnrollment::class, 'course_id')->with('student');
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'course_id');
    }
}
