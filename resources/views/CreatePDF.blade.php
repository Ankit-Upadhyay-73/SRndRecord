<!-- <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Document</title>

</head>

<body>
    

    {{-- creating header of MarkSheet --}}

    <div class="container" id="mainContainer">

        <div class="row">

            <div class="col-2" >
                {{-- <img src="{{$college->src}}" alt="Marksheet Values"> --}}
            </div>

            <div class="col-10">

                <div class="row">
                    {{-- collegeName Here --}}

                </div>

                <div class="row">

                    <div class="col-6">
                        {{-- address --}}
                    </div>

                    <div class="col-6">
                        {{-- grade with other rewards --}}
                    </div>

                </div>
                
                <div class="row">
                    
                    <div class="col-4">

                        {{-- phone number --}}

                    </div>

                    <div class="col-4">

                        {{-- Email --}}

                    </div>

                    <div class="col-4">

                        {{-- Website --}}

                    </div>

                </div>
            </div>{{-- end of col-10 --}}
            
        </div> {{-- end of row --}}

        {{-- student Details --}}
        <div class="row">

            <div class="row">
                {{-- row for student Name --}}
            </div>
            
            <div class="row">

                <div class="col-3">
                    {{-- Roll No --}}
                </div>

                <div class="col-3">
                    {{-- Stream --}}
                </div>

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

</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <layout-header></layout-header>
</body>
</html>