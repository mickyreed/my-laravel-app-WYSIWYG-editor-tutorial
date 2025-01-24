<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPageController;

Route::get('/', [StaticPageController::class, 'landingPage'])->name('landing');

//Route::get('/', function () {
//    return view('welcome');
//}) ;
