<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BucketController;
use App\Http\Controllers\BallController;
use App\Http\Controllers\OutputController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('buckets', BucketController::class);
Route::resource('balls', BallController::class);
Route::resource('output', OutputController::class);

Route::post('/output/show-output', [OutputController::class, 'showOutput'])->name('output.show_output');

Route::get('/', function () {
    return view('welcome');
});
