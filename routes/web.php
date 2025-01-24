<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\FormController;

Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/', [StaticPageController::class, 'landingPage'])->name('landing');

//Route::get('/', function () {
//    return view('welcome');
//}) ;
