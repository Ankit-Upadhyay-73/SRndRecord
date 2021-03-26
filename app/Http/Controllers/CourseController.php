<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function add(Request $request)
    {
        $course  = new Course();
        $course->name = $request->name;
        $course->save();
    }
}
