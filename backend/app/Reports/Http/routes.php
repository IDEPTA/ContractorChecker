<?php

use App\Reports\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::post('/', [ReportController::class, 'get']);
Route::get('/{id}', [ReportController::class, 'getById']);
Route::delete('/{id}', [ReportController::class, 'delete']);
