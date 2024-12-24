<?php

use App\Http\Controllers\CetakPdf;
use App\Http\Controllers\CrudStudent;
use App\Http\Controllers\CrudTeacher;
use App\Http\Controllers\Permit;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student;
use App\Http\Controllers\Teacher;
use App\Http\Controllers\User;
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
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('teach', CrudTeacher::class);
        Route::resource('siswa', CrudStudent::class);
        Route::resource('permits', Permit::class);
        Route::get('cetak', [CetakPdf::class, 'index'])->name('cetak.index');
        Route::get('/permits/report/pdf', [CetakPdf::class, 'generatePdf'])->name('cetak.pdf');
        Route::patch('permits/{permit}/updateStatus', [Permit::class, 'updateStatus'])->name('permits.updateStatus');
    });

    Route::middleware(['role:guru'])->group(function () {
        Route::resource('teacher', Teacher::class);
    });

    Route::middleware(['role:siswa'])->group(function () {
        Route::resource('student', Student::class);
    });
});


require __DIR__.'/auth.php';
