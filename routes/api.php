<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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

Route::post('/user/registration', [UserController::class,'register']);
Route::post('/college/update', [CollegeController::class,'update']);
Route::get('/college',[CollegeController::class,'show']);

Route::middleware(["auth:sanctum"])->group(function(){
    Route::prefix('students')->group(function () {
        Route::get("/",[StudentController::class,"index"]);
        Route::post("/",[StudentController::class,"store"]);
        Route::get("/{id}",[StudentController::class,"show"]);
    });

    Route::prefix('subjects')->group(function () {
        Route::get("/",[SubjectController::class,"index"]);
        Route::post("/",[SubjectController::class,"store"]);
    });

});

// Routes for marksheet
Route::post('/marksheet/create', 'ResultController@create');

//fetch subjects with Course

Route::get('/course', [SubjectController::class,'course']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

