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
        $logo = $request->file('logo');
        $logo_hash = strval(Carbon::now()->toTimeString().'_'.$logo->getClientOriginalName());
        $stamp_hash = strval(Carbon::now()->toTimeString().'_'.$stamp->getClientOriginalName());
        // storing file in storage
        Storage::disk('public')->put($logo_hash, File::get($stamp));
        Storage::disk('public')->put($stamp_hash, File::get($logo));

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

        $response_college = [];
        $response_college["logo"] = asset('storage/'.$college->logo);
        $response_college["stamp"] = asset('storage/'.$college->stamp);
        $response_college["address"] = $college->address;
        return response()->json($response_college);

    }

}
