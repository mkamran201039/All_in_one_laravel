<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/mail', function () {
    return view('mail');
});


Route::get('/create', function () {
    return view('create');
});


Route::get('/read', function () {
    return view('read');
});


Route::get('/update', function () {
    return view('update');
});


Route::get('/delete', function () {
    return view('delete');
});




Route::post('send/mail/data',[testController::class, 'send_mail_data'])->name('send.mail.data');
