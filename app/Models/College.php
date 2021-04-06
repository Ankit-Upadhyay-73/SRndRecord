<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','logo','address','stamp'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'college_user');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'college_course');
    }

}
