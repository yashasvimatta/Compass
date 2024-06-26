<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'assignment_id', 'marks_obtained', 'user_id', 'grade'];

    // Define the relationship with the User model for student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Define the relationship with the Assignment model
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    // Define the relationship with the User model for instructor (if needed)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
