<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::post('/pages', [PageController::class, 'update'])->name('pages.update');
Route::post('/pages/{page}/files', [PageController::class, 'upload'])->name('pages.upload');
