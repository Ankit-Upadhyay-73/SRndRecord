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
        $user = $request->user();
        $course = $user->courses()->latest('updated_at')->first();
        if($this->addSubject($request))
           {
                $added_subject = Subject::where('name',$request->name)->first();
                 //inserting into course_subject
                $course->subjects()->attach($added_subject->id);
                return response()->json($added_subject,201);
           }
        return response()->json(["message"=>"Subject Already Exists"],400);
    }

    public function addSubject(Request $request)
    {
        if (!Subject::where("name", $request->name)->exists()) {
            $subject = new Subject([
                'name'      =>  $request->name,
                'total'     =>  $request->weightage,
                'passing'   =>  $request->passing
            ]);
            $subject->save();
            return true;
        }
        return false;
    }

    public function index(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        return $user->courses->sortByDesc('updated_at')->first()->subjects;
    }

    public function course(Request $request)
    {
        return $request->user()->courses->sortByDesc('updated_at')->first();
    }
}
