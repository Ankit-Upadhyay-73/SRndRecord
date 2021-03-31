<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Mark;
use App\Models\Result;
use Illuminate\Http\Request;
use PDF;

class ResultController extends Controller
{
    //
    public function create(Request $request)
    {
        $student =  $request->student;

        //store all Subjects details with Obtained Marks
        $obtainedMarks = [];
        $weightages = [];
        $passingInEach = [];
        $data = $this->addToMarks($request, $passingInEach, $weightages, $obtainedMarks);
        return sizeof($request->$obtainedMarks);
        $passingInEach = $data[0];
        $weightages = $data[1];
        $obtainedMarks = $data[2];

        $exam = Exam::where("name", $request->exam)->get();
        if ($exam->count() == 0)
            $examid = $this->addExam($request);
        else
            $examid = $exam[0]->id;

        //variales to  create final result
        $totalObtained = 0;
        $totalWeightage = 0;
        $totalPassing = 0;
        $result = true;

        for ($i = 0; $i < sizeOf($obtainedMarks); $i++) {
            $totalObtained += $obtainedMarks[$i];
            $totalWeightage += $weightages[$i];
            $totalPassing += $passingInEach[$i];

            if ($obtainedMarks[$i] < $weightages[$i])
                $result = false;
        }

        //calculate result
        $percentage = ($totalObtained / $totalWeightage) * 100;
        if ($request) {
            if ($totalObtained < $totalPassing)
                $result = false;
            else
                $request = true;
        }

        Result::create([
            'student_id' => $student,
            'exam_id' => $examid,
            'status' => $result,
            'percentage' => $percentage
        ]);


        return response()->json(["message" => "Result Created Successfully"]);
    }

    public function addExam(Request $request)
    {
        $exam = new Exam();
        $exam->name = $request->exam;
        $exam->year = $request->year;
        $exam->save();
        return $exam->id;
    }

    public function addToMarks(Request $request, $passingInEach, $weightages, $obtainedMarks)
    {
        $dataSet = [];
        $subjects =  $request->subjects;
        foreach ($subjects as $subject) {

            $mark = $subject["obtained"];
            $passing = $subject["passing"];
            $weightage = $subject["total"];

            //pushing data in array to create result
            array_push($passingInEach, $passing);
            array_push($weightages, $weightage);
            array_push($obtainedMarks, $mark);

            // adding record to marks table
            Mark::create([
                'student_id' => $request->student,
                'subject_id' => $subject["id"],
                'obtabinedMarks' => $mark,
                'total' => $weightage
            ]);
        }
        array_push($dataSet, $passingInEach);
        array_push($dataSet, $weightages);
        array_push($dataSet, $obtainedMarks);
        return $dataSet;
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
