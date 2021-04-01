<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CollegeController extends Controller
{
    //

    public function update(Request $request)
    {

        request()->validate([
            'address' => 'required',
            'logo' => 'required',
            'stamp' => 'required'
        ]);

        $college_id = $request->user()->colleges[0]->id;
        $college = College::find($college_id);

        $stamp =  $request->file('stamp');
        $stamp_extension = $stamp->getClientOriginalExtension();
        $logo = $request->file('logo');
        $logo_extension = $logo->getClientOriginalExtension();
        Storage::disk('public')->put($college->name . '_stamp' . '.' . $stamp_extension, File::get($stamp));
        Storage::disk('public')->put($college->name . '_logo' . '.' . $logo_extension, File::get($logo));

        $college_id = $request->user()->colleges[0]->id;
        $college = College::find($college_id);
        $college->address = $request->address;
        $college->logo = $request->file('logo')->getClientOriginalName();
        $college->stamp = $request->file('stamp')->getClientOriginalName();
        $isSaved = $college->save();

        if ($isSaved) {
            return response()->json(['message' => 'Saved Successfully']);
        }
        return response()->json(['message' => 'Request Failed']);
    }
}
