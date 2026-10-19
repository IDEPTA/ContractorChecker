<?php

use App\Reports\Http\Controllers\ReportController;
use App\Reports\Http\Controllers\ReportFileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/', [ReportController::class, 'get']);
    Route::get('/{id}', [ReportController::class, 'getById']);
    Route::delete('/{id}', [ReportController::class, 'delete']);
});



Route::get('/{report}/download', [ReportFileController::class, 'download'])
    ->name('reports.file.download');

Route::get('/{report}/preview', [ReportFileController::class, 'preview'])
    ->name('reports.file.preview');
