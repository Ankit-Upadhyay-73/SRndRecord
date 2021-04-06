<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //

    public function store(Request $request)
    {
        //
        $user = $request->user();
        $college_id = $user->colleges()->latest()->first()->id;
        $course = $user->courses()->latest()->first();
        if($this->addSubject($request))
           {
                $added_subject = Subject::where('name',$request->name)->first();
                 //inserting into course_subject
                $course->subjects()->attach($added_subject->id);
                // ['college_id'=>$college_id]
                DB::update(DB::raw("UPDATE course_subject SET college_id={$college_id} where subject_id=$added_subject->id"));
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
        $college_id = $user->colleges()->latest()->first()->id;
        $course_id = $user->courses()->latest()->first()->id;
        //fetching subjects in head course
        $subjects = DB::select(DB::raw("select course_subject.subject_id from course_subject where course_subject.course_id = $course_id  and course_subject.college_id= $college_id"));
        $computed_subjects = array_map(function($subject){

            return Subject::find($subject->subject_id);

        },$subjects);

        return $computed_subjects;

        // return $user->courses->sortByDesc('updated_at')->first()->subjects;

    }

    public function course(Request $request)
    {
        return $request->user()->courses->sortByDesc('updated_at')->first();
    }
}
