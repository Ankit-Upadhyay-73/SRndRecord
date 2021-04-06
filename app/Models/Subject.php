<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [

        'name','total','passing'

    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_id');
    }

    // public function college(){
    //     return $this->belongsTo(College::class, 'college_id');
    // }

}
