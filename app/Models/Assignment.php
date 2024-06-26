<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'user_id', 'title', 'description', 'due_date', 'file_path'];

    // Define the relationship with the Course model
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
