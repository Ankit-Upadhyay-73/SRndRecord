<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', function () {

//     $dom = new DOMDocument();
//     $dom->validateOnParse = true;
//     $dom->loadHTML(view('PDF.CreatePDF')->render());
//     $dom->saveHTML();
//     $dom->preserveWhiteSpace = false;

//     $html2pdf = new Html2Pdf();
//     $val = $dom->getElementById("mainContainer");
//     $html2pdf->writeHTML($val);
//     $html2pdf->output('example01.pdf');

// });
