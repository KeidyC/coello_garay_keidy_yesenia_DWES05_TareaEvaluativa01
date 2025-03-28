<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas para los Libros
Route::get('/libros','App\Http\Controllers\LibroController@getAllLibros');
Route::get('/libros/{id}','App\Http\Controllers\LibroController@getLibroById');
Route::post('/libros/create','App\Http\Controllers\LibroController@createLibro');
Route::put('/libros/update/{id}','App\Http\Controllers\LibroController@updateLibro');
Route::delete('/libros/delete/{id}','App\Http\Controllers\LibroController@deleteLibro');

// Rutas para los Autores
Route::get('/autores','App\Http\Controllers\AutorController@getAllAutores');
Route::get('/autores/{id}','App\Http\Controllers\AutorController@getAutorById');
Route::post('/autores/create','App\Http\Controllers\AutorController@createAutor');
Route::put('/autores/update/{id}','App\Http\Controllers\AutorController@updateAutor');
Route::delete('/autores/delete/{id}','App\Http\Controllers\AutorController@deleteAutor');

// Rutas para las Categorias
Route::get('/categorias','App\Http\Controllers\CategoriaController@getAllCategorias');
Route::get('/categorias/{id}','App\Http\Controllers\CategoriaController@getCategoriaById');
Route::post('/categorias/create','App\Http\Controllers\CategoriaController@createCategoria');
Route::put('/categorias/update/{id}','App\Http\Controllers\CategoriaController@updateCategoria');
Route::delete('/categorias/delete{id}','App\Http\Controllers\CategoriaController@deleteCategoria');