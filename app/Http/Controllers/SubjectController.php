<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //

    public function store(Request $request)
    {
        //
        $user = User::findOrFail($request->user()->id);
        $course = $user->courses[0];
        $subject = $this->addSubject($request);
        //inserting into course_subject
        $course->subjects()->attach($subject->id);
        return true;
    }

    public function addSubject(Request $request)
    {
        $subject = Subject::where("name", $request->name)->get();
        if ($subject->count() == 0) {
            $subject = new Subject();
            $subject->name = $request->name;
            $subject->total = $request->weightage;
            $subject->passing = $request->passing;
            $subject->save();
            return $subject;
        }
        return $subject[0];
    }

    public function index(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        return $user->courses[0]->subjects;
    }

    public function fetchSubjectsWithCourse(Request $request)
    {
        return $request->user()->courses[0]->subjects;
    }
}
