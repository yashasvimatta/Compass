<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'first_name',
        'last_name',
        'phone',
        'address',
        'dob',
        'email',
        'password',
        'cpassword',
        'profile_pic',
        'institution',
        'education',
        'research_field',
        'experience',
        'race',
        'ethnicity',
        'marital_status',
        'gender',
        'resume',
        'cv',
        'statement',
        'status',
    ];

    protected $dates = [
        'dob', // Make sure to cast 'dob' as a date
    ];

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_enrollments', 'user_id', 'course_id')
            ->withTimestamps();
    }
}
