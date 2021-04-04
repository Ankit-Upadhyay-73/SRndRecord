<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $hidden = ["pivot"];

    protected $fillable = [
        'name','duration'
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_subject');
    }

    public function colleges()
    {
        return $this->belongsToMany(College::class, 'college_course');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user');
    }
}
