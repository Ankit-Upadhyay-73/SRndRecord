<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    //

    public function index(Request $request)
    {
        $students = [];
        $user = $request->user();
        $college = $user->colleges->sortByDesc('updated_at')->first();
        $students_in_college =  Student::where('college_id', $college->id)->get();
        foreach ($students_in_college as $student) {
            $students[] = $student->user;
        }

        return $students;

    }

    public function validateRequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        //Initiating the user
        if (User::where('email', $request->email)->exists()) {
            return response()->json(["message" => "User Exists"],400);
        }
        else {
            $user = new User([
                "name"      =>   $request->name,
                "email"     =>   $request->email,
                'phone'     =>   $request->phone,
                "password"  =>   $request->password
            ]);

            //finding the role
            if (!Role::where('name','Student')->exists()){
                $role = new Role(["name" => "Student","display_name"=> Str::upper("Student")]);
                $role->save();
            }
            else
                $role = Role::where('name','Head')->first();

            //registering the role
            $user->role_id = $role->id;

            //saving the user
            $user->save();

            //checking college and courses details
            if ($request->user()->colleges()->exists())
            {
                if ($request->user()->courses()->exists()) {
                    //saving details to students table
                    $student = new Student(
                            [
                                "user_id" => $user->id,
                                "college_id"=>$request->user()->colleges()->first()->id,
                                "course_id" =>$request->user()->courses()->first()->id,
                            ]
                        );

                    $student->save();

                    return response()->json($user,201);
                }
            }
            else {
                $user->delete();
                return response()->json(["message" => "Collge and Courses  does not exists"],400);
            }
        }
    }

    public function show(Request $request, $id)
    {
        $course_id = $request->user()->courses()->first()->id;
        // return $studentname = User::find($id);
        $student = [];
        if (Student::where(['id' => $id, 'course_id' => $course_id])->exists())
        {
            $user_id  = Student::find($id)->user->id;
            $student = User::find($user_id);
        }

        return response()->json($student);

    }
}
