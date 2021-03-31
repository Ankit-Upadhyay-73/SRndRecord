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

//Head Operations

Route::post('/user/registration', 'UserController@register');
Route::post('/user/login', 'UserController@login')->middleware('auth:sanctum');
Route::post('/college/update', 'CollegeController@update');
//Student Operations

Route::post('/student', 'StudentController@add')->middleware('auth:sanctum');
Route::get('/students', 'StudentController@index')->middleware('auth:sanctum');
Route::get('/student/{id}', 'StudentController@show');

//Subject Operations

Route::post('/subject', 'SubjectController@store')->middleware('auth:sanctum');
Route::get('/subjects', 'SubjectController@index')->middleware('auth:sanctum');


//MarkSheet Operations

Route::post('/marksheet/create', 'ResultController@create')->middleware('auth:sanctum');

Route::get('/marksheet/print', 'ResultController@createMarksheetPDF');

//fetch subjects with Course

Route::get('/fetchSubjectsWithCourse', 'SubjectController@fetchSubjectsWithCourse');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
