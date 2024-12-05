<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', [TestController::class, 'test'])->name('test');

Route::get('/test-render', [TestController::class, 'test_render'])->name('test_render');