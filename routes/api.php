<?php

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Cookie as HttpFoundationCookie;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes();


// Routes for head

Route::post('/user/registration', 'UserController@register');
Route::post('/college/update', 'CollegeController@update')->middleware('auth');

// Routes for student
Route::post('/student', 'StudentController@add');
Route::get('/students', 'StudentController@index');
Route::get('/student/{id}', 'StudentController@show');

// Routes for subject
Route::post('/subject', 'SubjectController@store');
Route::get('/subjects', 'SubjectController@index');

// Routes for marksheet
Route::post('/marksheet/create', 'ResultController@create');

Route::get('/marksheet/print', 'ResultController@createMarksheetPDF');

//fetch subjects with Course

Route::get('/fetchSubjectsWithCourse', 'SubjectController@fetchSubjectsWithCourse');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

