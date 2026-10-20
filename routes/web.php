<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SchoolClass\CreateController;
use App\Http\Controllers\SchoolClass\DestroyController;
use App\Http\Controllers\SchoolClass\EditController;
use App\Http\Controllers\SchoolClass\IndexController;
use App\Http\Controllers\SchoolClass\ShowController;
use App\Http\Controllers\SchoolClass\StoreController;
use App\Http\Controllers\SchoolClass\UpdateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::get('/login', [AuthController::class, 'loginview'])->name('login-view')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login-post')->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->name('register-view')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register-post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::name('students.')->middleware(['role:student,teacher', 'auth'])->prefix('students')->group(function () {

    // Halaman Daftar Siswa
    Route::get('/', [StudentController::class, 'index'])->name('index');

    // Halaman Tambah Siswa
    Route::get('/create', [StudentController::class, 'create'])->name('create');

    // Halaman Detail Siswa
    Route::get('/{student}', [StudentController::class, 'show'])->name('show')->whereNumber('student');

    // Halamann Edit Siswa
    Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');

    // Logika Tambah Siswa
    Route::post('/', [StudentController::class, 'store'])->name('store');

    // Logika Edit Siswa
    Route::put('/{student}', [StudentController::class, 'update'])->name('update');

    // Logika Hapus Siswa
    Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
});

// Teacher Management
Route::name('teachers.')->middleware(['role:teacher', 'auth'])->prefix('teachers')->group(function () {

    // Halaman Daftar Guru
    Route::get('/', [TeacherController::class, 'index'])->name('index');

    // Halaman Detail Guru
    Route::get('/{teacher}', [TeacherController::class, 'show'])->name('show')->whereNumber('teacher');

    // Halaman Tambah Guru
    Route::get('/create', [TeacherController::class, 'create'])->name('create');

    // Halamann Edit Guru
    Route::get('/{teacher}/edit', [TeacherController::class, 'edit'])->name('edit')->whereNumber('teacher');

    // Logika Tambah Guru
    Route::post('/', [TeacherController::class, 'store'])->name('store');

    // Logika Edit Guru
    Route::put('/{teacher}', [TeacherController::class, 'update'])->name('update')->whereNumber('teacher');

    // Logika Hapus Guru
    Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('destroy')->whereNumber('teacher');
});

// Major Management
Route::resource('majors', MajorController::class)->middleware(['role:teacher', 'auth']);

// School Class Management
Route::name('classes.')->middleware(['role:teacher', 'auth'])->prefix('classes')->group(function () {

    Route::get('/', IndexController::class)->name('index');

    Route::get('/{schoolClass}', ShowController::class)->name('show')->whereNumber('schoolClass');

    Route::get('/create', CreateController::class)->name('create');

    Route::get('/{schoolClass}/edit', EditController::class)->name('edit')->whereNumber('schoolClass');

    Route::post('/', StoreController::class)->name('store');

    Route::put('/{schoolClass}', UpdateController::class)->name('update')->whereNumber('schoolClass');

    Route::delete('/{schoolClass}', DestroyController::class)->name('destroy')->whereNumber('schoolClass');

});
