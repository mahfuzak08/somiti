<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\InventoryController;
use App\Models\Address;
use App\Models\Nominee;
use App\Models\Role;

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

/**
 * Admin panel route
 */
Route::get('/profile', function () {
    $data["role"] = Role::all();
    $data["address"] = Address::where('user_id', auth()->user()->id)->get();
    $data["nominee"] = Nominee::where('user_id', auth()->user()->id)->get();
    return view('admin.profile')->with($data);
})->middleware(['auth', 'verified']);

Route::get('/change-password', function () {
    return view('admin.change-password');
})->middleware(['auth', 'verified']);

Route::get('/home', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified']);

Route::controller(InventoryController::class)->prefix('inventory')->group(function () {
    Route::get('/brands', 'brands')->middleware(['auth', 'verified']);
    Route::get('/brands-add/{id?}', 'brandForm')->middleware(['auth', 'verified']);
    Route::post('/brands-save', 'brandSave')->middleware(['auth', 'verified'])->name('brand.save');
    Route::delete('/brands-delete/{id}', 'brandRemove')->middleware(['auth', 'verified']);
    
    Route::get('/categories', 'categories')->middleware(['auth', 'verified']);
    Route::get('/categories-add/{id?}', 'categoriesForm')->middleware(['auth', 'verified']);
    Route::post('/categories-save', 'categoriesSave')->middleware(['auth', 'verified'])->name('category.save');
    Route::delete('/categories-delete/{id}', 'categoriesRemove')->middleware(['auth', 'verified']);
});

// Route::prefix('settings')->group(function () {
//     Route::get('/users', [Users::class, 'index'])->middleware(['auth', 'verified']);
//     Route::get('/users-add', [Users::class, 'add'])->middleware(['auth', 'verified']);
// });

Route::controller(Users::class)->prefix('settings')->group(function () {
    Route::get('/users', 'index')->middleware(['auth', 'verified']);
    Route::get('/users-add/{type}/{id?}', 'addForm')->middleware(['auth', 'verified']);
    Route::post('/users-save', 'save')->middleware(['auth', 'verified'])->name('user.save');
    Route::delete('/users-delete/{id}', 'remove')->middleware(['auth', 'verified']);
    Route::post('/users-address-save/{type?}/{id?}', 'addressSave')->middleware(['auth', 'verified'])->name('address.save');
    Route::delete('/address-delete/{id?}', 'addressDelete')->middleware(['auth', 'verified']);
    Route::post('/users-nominee-save/{type?}/{id?}', 'nomineeSave')->middleware(['auth', 'verified'])->name('nominee.save');
    Route::delete('/nominee-delete/{id?}', 'nomineeDelete')->middleware(['auth', 'verified']);

    Route::get('/role', 'role')->middleware(['auth', 'verified']);
    Route::get('/role-add/{id?}', 'roleForm')->middleware(['auth', 'verified']);
    Route::post('/role-save', 'roleSave')->middleware(['auth', 'verified'])->name('role.save');
    Route::delete('/role-delete/{id}', 'roleRemove')->middleware(['auth', 'verified']);
});