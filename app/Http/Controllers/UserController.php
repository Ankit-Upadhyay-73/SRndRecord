<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //

    public function register(Request $request)
    {
        // if (User::where('phone', $request->phone)->exists())
        //     return response()->json(["message" => "Phone already exists"])->setStatusCode(400);

        // $college = College::with("course")->where('name', $request->college)->first();

        // if (is_null($college)) {
        //     $college = College::create([
        //         "name" => $request->college
        //     ]);
        //     $college->courses()->create([
        //         "name" => $request->course
        //     ]);
        // }

        // $user = $this->createUser($request);

        // $role_id = $this->createRole($request);
        // //registering the role
        // $user->role_id = $role_id;

        // //saving the user
        // $user->save();

        // // add to college_user
        // $college = $this->addingToCollege($request);
        // $college->users()->attach($user->id);

        // //add to course

        // $course = $this->addToCourse($request);
        // $college->courses()->attach($course);

        // $course->users()->attach($user);

        // return response()->json($user, 201);;

        if (
                User::where('phone', $request->phone)
                    ->orWhere('email', $request->email)
                    ->exists()
            )
            return response()
                        ->json(["message" => "You are already registered"])
                        ->setStatusCode(422);
        else {

            if ($this->headExists($request))
                return response()->json(["message" => "Head of course already exists"])->setStatusCode(422);
            else {
                $user = $this->createUser($request);

                $role_id = $this->createRole($request);

                $user->role_id = $role_id;
                $user->save();

                // add to college_user
                $college = $this->addingToCollege($request);
                $college->users()->attach($user->id);

                //add to course

                $course = $this->addToCourse($request);
                $college->courses()->attach($course);

                $course->users()->attach($user);

                return response()->json($user, 201);;
            }
        }
    }

    public function headExists($request)
    {
        $college = College::where('name', $request->college)->get();
        if ($college->count() == 0)
            return false;
        else {
            if ($college[0]->courses->count() > 0) {
                if ($college[0]->courses[0]->name == $request->course)
                    return true;
            }
            return false;
        }
    }

    public function createUser(Request $request)
    {
        $user = new User(
            [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "password" => Hash::make($request->password)
            ]
        );
        return $user;
    }

    public function createRole(Request $request)
    {
        //finding the role
        // $role = Role::where("name", "Head")->get();
        // //finding the role
        // if ($role->count() == 0) {
        //     $role = new Role();
        //     $role->name = "Head";
        //     $role->display_name = Str::upper("Head");
        //     $role->save();
        //     return $role->id;
        // } else
        //     return $role[0]->id;

        //finding the role

        //finding the role

        if (!Role::where("name", "Head")->exists()) {
            $role = new Role(
                [
                    "name" => "Head",
                    "display_name" => Str::upper("Head"),
                ]
            );
            $role->save();
            return $role->id;
        } else
            return Role::where("name", "Head")->pluck('id')[0]; //to fetch role_id from Collection having one element


    }

    public function addingToCollege(Request $request)
    {

        $college = College::firstOrCreate([
            'name' => $request->college
        ],     [
                    "name" => $request->college,
                    "logo" => "",
                    "address" => "",
                    "stamp" => ""
                ]);
            return $college;

        if (!College::where('name', $request->college)->exists()) {
            $college = new College(
                [
                    "name" => $request->college,
                    "logo" => "",
                    "address" => "",
                    "stamp" => ""
                ]
            );
            $college->save();
            return $college;
        } else
            return College::where('name', $request->college)->first();
    }


    public function addToCourse(Request $request)
    {

        if (!Course::where("name", $request->course)->exists()) {
            $course = new Course(
                [
                    "name" => $request->course,
                    "duration" => 1,
                ]
            );
            $course->save();
            return $course;
        }
        return Course::where("name", $request->course)->first();
    }
}
