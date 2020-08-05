<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('contenido');
});

Route::get('/sudoku-historial/jugadores', 'SudokuController@index');
Route::post('/sudoku-partida/store', 'SudokuController@store');