<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('profile.show');

//Profiles Route
Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'index']);
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfileController::class, 'edit']);
Route::patch('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'update']);

//Ideas route
Route::get('/ideas/create', [App\Http\Controllers\IdeasController::class, 'create']);
Route::post('ideas', [App\Http\Controllers\IdeasController::class, 'store']);
// Route::post('get-video/{video}', [App\Http\Controllers\IdeasController::class, 'getVideo'])->name('getVideo');
