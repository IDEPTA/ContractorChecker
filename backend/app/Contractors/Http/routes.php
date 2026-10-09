<?php

use App\Contractors\Http\Controllers\CounterpartyController;
use Illuminate\Support\Facades\Route;


Route::post('/', [CounterpartyController::class, 'get']);
Route::get('/{id}', [CounterpartyController::class, 'getById']);
Route::delete('/{id}', [CounterpartyController::class, 'delete']);
