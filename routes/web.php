<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;

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
    return view('home');
});

Route::get('/home', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified']);

Route::get('/profile', function () {
    return view('admin.profile');
})->middleware(['auth', 'verified']);

Route::get('/change-password', function () {
    return view('admin.change-password');
})->middleware(['auth', 'verified']);

// Route::prefix('settings')->group(function () {
//     Route::get('/users', [Users::class, 'index'])->middleware(['auth', 'verified']);
//     Route::get('/users-add', [Users::class, 'add'])->middleware(['auth', 'verified']);
// });

Route::controller(Users::class)->group(function () {
    Route::get('/users', 'index')->middleware(['auth', 'verified']);
    Route::get('/users-add', 'addForm')->middleware(['auth', 'verified']);
    Route::post('/users-save', 'save')->middleware(['auth', 'verified']);
});