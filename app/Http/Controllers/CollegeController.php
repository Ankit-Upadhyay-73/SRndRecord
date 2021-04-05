<?php

namespace App\Http\Controllers;

use App\Models\College;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

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
        $logo_hash = strval(Hash::make($request->file('logo')->getClientOriginalName()));

        $stamp_hash = strval(Hash::make($request->file('stamp')->getClientOriginalName()));
        Storage::disk('public')->put($logo_hash. '.' . $stamp_extension, File::get($stamp));
        Storage::disk('public')->put($stamp_hash. '.' . $logo_extension, File::get($logo));

        $college->address = $request->address;
        $college->logo = $logo_hash;
        $college->stamp = $stamp_hash;
        $isSaved = $college->save();

        if ($isSaved) {
            return response()->json(['message' => 'Saved Successfully']);
        }
        return response()->json(['message' => 'Request Failed'],400);
    }

    public function show(Request $request){

        $college_id = $request->user()->colleges->sortByDesc('updated_id')->first()->id;
        $college =  College::find($college_id);
        $name = $college->name;
        $logo = $college->logo;
        $stamp = $college->stamp;
        $address = $college->address;
        $logoPath = Storage::disk('public')->get($logo.'.png');
        $stampPath = Storage::disk('public')->get($stamp.'.png');

        $response_college = [];

        $response_college["address"] = $address;
        $response_college["logo"] = $logoPath;
        $response_college["stamp"] =  $stampPath;

        return response()->json($response_college);

    }

}
