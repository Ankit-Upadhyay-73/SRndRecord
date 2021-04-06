<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Mark;
use App\Models\Result;
use App\Models\Subject;
use Illuminate\Http\Request;
use PDF;

class ResultController extends Controller
{
    //
    public function create(Request $request)
    {
        $marksheets = [];
        $total_obtained= 0 ;
        $total_weightage=0;
        $result_status = true;
        collect($request->subjects)->map(function($subject) use
                        ($marksheets,$request,$total_obtained,$total_weightage)
                        {
                            $marksheets[] = [
                                'student_id'=>$request->student,
                                'subject_id'=>$subject["id"],
                                'obtainedMarks'=>$subject["obtained"],
                                'total'=>$subject["total"]
                            ];

                            $total_obtained+=$subject["obtained"];
                            $total_weightage+=$subject["total"];
                            if($subject["obtained"] < $subject["passing"]){
                                $this->result_status = false;
                            }

                        }
            );

        Mark::insert($marksheets);

        if(!Exam::where('name',$request->exam)->exists())
        {
            Exam::create([
                'name' => $request->exam,
                'year' => $request->year
            ]);
        }

        $percentage = ($total_obtained/$total_weightage)*100;

        $exam = Exam::where('name',$request->exam)->first();

        Result::create([
            'student_id' => $request->student,
            'exam_id' => $exam->id,
            'status' => $result_status,
            'percentage' => $percentage
        ]);

        return response()->json(["message" => "Result Created Successfully"]);

    }


    public function createMarksheetPDF()
    {

        // return view('CreatePDF');

        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
        ];


        $pdf = PDF::loadView('CreatePDF', $data);

        return $pdf->download('medium.pdf');
    }
}
