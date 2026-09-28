<?php

use App\Reports\Http\ReportFileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/reports/{report}/file/download',
    [ReportFileController::class, 'download']
)->name('reports.file.download');

Route::get(
    '/reports/{report}/file/preview',
    [ReportFileController::class, 'preview']
)->name('reports.file.preview');
