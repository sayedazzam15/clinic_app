<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\UserController;
use App\Models\Doctor;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    echo 'welcome laravel';
    // return view('welcome');
});

//
Route::get('/home', [UserController::class, 'index']);
Route::get('/majors', [MajorController::class, 'index'])->name('major.index');



Route::resource('doctor', DoctorController::class);



Route::get('/majors/{id}/edit', [MajorController::class, 'edit'])->name('major.edit');
Route::put('/majors/{id}', [MajorController::class, 'update'])->name('major.update');

Route::get('/majors/{major}', [MajorController::class, 'show'])->name('major.show');

Route::get('/major/create', [MajorController::class, 'create'])->name('major.create');
Route::post('/majors', [MajorController::class, 'store'])->name('major.store');
Route::delete('/majors/{id}', [MajorController::class, 'destroy'])->name('majors.delete');
// create -> post
// update -> put
// delete -> delete
