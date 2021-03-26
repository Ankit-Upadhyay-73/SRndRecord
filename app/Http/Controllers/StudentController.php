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

    public function index()
    {
        $role = Role::where('name', 'student')->get();
        $role_id = $role[0]["id"];
        $user = User::where('role_id', $role_id)->get();
        return $user;
    }

    public function validateRequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
        ]);
    }

    public function add(Request $request)
    {
        $this->validateRequest($request);
        //Initiating the user
        $user = User::where('email', $request->email)->get();
        if ($user->count() != 0) {
            return response()->json(["message" => "Student Exists"]);
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            //finding the role
            $role = Role::where("name", "student")->get();
            //finding the role
            if ($role->count() == 0) {
                $role = new Role();
                $role->name = "student";
                $role->display_name = Str::upper("Student");
                $role->save();
            } else
                $role = $role[0];
            //registering the role
            $user->role_id = $role->id;

            //saving the user
            $user->save();
            //checking college and courses details
            if ($request->user()->colleges->count() != 0) {
                if ($request->user()->courses->count() != 0) {
                    //saving details to students table
                    $student = new Student();
                    $student->user_id = $user->id;
                    $student->college_id = $request->user()->colleges[0]['id'];
                    $student->course_id = $request->user()->courses[0]['id'];
                    $student->save();

                    return response()->json($user);
                }
            } else {
                $user->delete();
                return response()->json(["message" => "Collge and Courses details does not exists"]);
            }
        }
    }

    public function show(Request $request, $id)
    {
        $course_id = $request->user()->courses[0]->id;
        return $studentname = User::find($id);
        $student  = Student::where(['id' => $id, 'course_id' => $course_id])->count();
        $studentname = "Not Found";
        if ($student > 0)
            $studentname = User::find($id)->get();
        return $studentname;
    }
}
