<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    //

    public function update(Request $request)
    {
        $college_id = $request->user()->colleges[0]->id;
        $college = College::find($college_id);
        $college->address = $request->address;
        $college->logo = $request->logo;
        $college->stamp = $request->stamp;
        $isSaved = $college->save();

        if ($isSaved) {
            return response()->json(['message' => 'Saved Successfully']);
        }
        return response()->json(['message' => 'Request Failed']);
    }
}
