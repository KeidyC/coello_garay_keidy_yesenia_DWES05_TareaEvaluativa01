<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('alumno',function(){
    return view('alumno_vista');
})->name('alumno_ruta');