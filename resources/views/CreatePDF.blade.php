 <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
        }
    </style>

</head>

<body>

    {{-- creating header of MarkSheet --}}

    <div class="row" style="justify-content:center">

        <h3 style="font-family: Comic Sans MS">
            Marksheet of stud_name
        </h3>

    </div>

    <div class="container mt-5 shadow-lg p-5" id="mainContainer">

        <div class="row">

            <div class="col-2" >
                <img src="http://www.avc.ac.in/images/logo.png" alt="Marksheet Values">
            </div>

            <div class="col-10">

                <div class="row" style="justify-content: center">

                    <h3 style="font-family: 'Times New Roman', Times, serif;">Annasaheb Vartak College</h3>

                </div>

                <div class="row mt-2">

                    <div class="col-6">
                        Address : Vasai Road
                    </div>

                    <div class="col-6">
                        Grade Obtained : B+
                    </div>

                </div>

                <div class="row mt-2">

                    <div class="col-4">

                        Contact: +91-0220220220220

                    </div>

                    <div class="col-4">

                        Email: enquiry@vartak.com

                    </div>

                    <div class="col-4">

                        Website: http://www.avc.ac.in

                    </div>

                </div>
            </div>{{-- end of col-10 --}}

        </div> {{-- end of row --}}

        {{-- student Details --}}
        <div class="row mt-4">

            <div class="col" >
                Name:Ankit Upadhyay
            </div>
            <div class="col" >
                Roll N0: 73
            </div>
            <div class="col" >
                Stream: BScIT
            </div>

        </div>    {{-- end of student personal info --}}

        {{-- Now Subject with Grade --}}

        <div class="row">

            <table class="table">

                <tr>
                    <th>Subject</th>
                    <th>Weightage</th>
                    <th>Passing</th>
                    <th>Obtained</th>
                </tr>

                {{-- @foreach ($subject as $subjects) --}}

                    <tr>
                        {{-- <td>{{$subject->name}}</td>
                        <td>{{$subject->weightage}}</td>
                        <td>{{$subject->Passing}}</td>
                        <td>{{$subject->Obtained}}</td> --}}
                    </tr>

                {{-- @endforeach --}}

            </table>

            <div class="divider"></div>

            <div class="row justify-content-flex-end">
                <div class="col-3">
                    Total
                </div>

                <div class="col-3">
                    {{-- total value --}}
                </div>
            </div>

            <div class="row justify-content-flex-end">
                <div class="col-3">
                    Total in %
                </div>

                <div class="col-3">
                    {{-- total marks in % --}}
                </div>
            </div>

        </div>            {{-- end of Result Section --}}

        <div class="row">
            {{-- Marks Obtained --}}
        </div> {{-- to show the marks and % with respect to total --}}

        <div class="row justify-content-end">

            {{-- stamp goes here --}}

        </div>

    </div>


</body>

</html>


<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>

-->
