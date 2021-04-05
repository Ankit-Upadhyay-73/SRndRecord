<?php

namespace App\Http\Controllers;

use App\Models\College;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CollegeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function update(Request $request)
    {

        request()->validate([
            'address' => 'required',
            'logo' => 'required',
            'stamp' => 'required'
        ]);

        $college_id = $request->user()->colleges->sortByDesc('updated_at')->first()->id;
        $college = College::find($college_id);

        $stamp =  $request->file('stamp');
        $stamp_extension = $stamp->getClientOriginalExtension();
        $logo = $request->file('logo');
        $logo_extension = $logo->getClientOriginalExtension();
        Storage::disk('public')->put(Carbon::now()->toDateString()."_".$college->name . '_stamp' . '.' . $stamp_extension, File::get($stamp));
        Storage::disk('public')->put(Carbon::now()->toDateString()."_".$college->name . '_logo' . '.' . $logo_extension, File::get($logo));

        $college->address = $request->address;
        $college->logo = $request->file('logo')->getClientOriginalName();
        $college->stamp = $request->file('stamp')->getClientOriginalName();
        $isSaved = $college->save();

        if ($isSaved) {
            return response()->json(['message' => 'Saved Successfully']);
        }
        return response()->json(['message' => 'Request Failed'],400);
    }

    public function show(Request $request){

        $college_id = $request->user()->colleges->sortByDesc('updated_id')->first();
        $college =  College::find($college_id);
        $name = $college->name;
        $address = $college->address;
        $logoPath = Storage::disk('public')->get('[*]'+"_"+$name+"_logo");
        $stampPath = Storage::disk('public')->get('[*]'+"_"+$name+"_logo");

        $response_college = [];

        $response_college["address"] = $address;
        $response_college["logo"] = $logoPath;
        $response_college["stamp"] =  $stampPath;

        return response()->json($response_college);

    }

}
