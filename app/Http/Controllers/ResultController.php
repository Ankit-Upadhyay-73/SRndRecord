<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Mark;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    //

    public function create(Request $request)
    {
        return $request->all();
        //fetching data from request
        $student =  $request->student;

        //store all Subjects details with Obtained Marks
        $obtainedMarks = [];
        $weightages = [];
        $passingInEach = [];
        $data = $this->addToMarks($request, $obtainedMarks, $weightages, $passingInEach);
        $obtainedMarks = $data[0];
        $weightages = $data[1];
        $passingInEach = $data[2];

        $exam = Exam::where("name", $request->exam)->get();
        if ($exam->count() == 0)
            $examid = $this->addExam($request);
        else
            $examid = $request->exam;

        //variales to  create final result
        $totalObtained = 0;
        $totalWeightage = 0;
        $totalPassing = 0;
        $result = "";

        for ($i = 0; $i < sizeOf($obtainedMarks); $i++) {
            $totalObtained += $obtainedMarks[$i];
            $totalWeightage += $weightages[$i];
            $totalPassing += $passingInEach[$i];

            if ($obtainedMarks[$i] < $weightages[$i])
                $result = "Fail";
        }

        //calculate result
        $percentage = ($totalObtained / $totalWeightage) * 100;
        if ($totalObtained < $totalPassing)
            $result = "Fail";
        else
            $request = "Pass";

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
            $weightage = $subject["weightage"];

            //pushing data in array to create result
            array_push($passingInEach, $passing);
            array_push($weightages, $weightage);
            array_push($obtainedMarks, $mark);

            //adding record to marks table
            // Mark::create([
            //     'student_id' => $request->student,
            //     'subject_id' => $subject["id"],
            //     'obtabinedMarks' => $mark,
            //     'total' => $weightage
            // ]);
        }
        array_push($dataSet, $passingInEach);
        array_push($dataSet, $weightages);
        array_push($dataSet, $obtainedMarks);
        return $dataSet;
    }
}
