<?php
 
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SchoolClass\IndexController;
use App\Http\Controllers\SchoolClass\ShowController;
use App\Http\Controllers\SchoolClass\CreateController;
use App\Http\Controllers\SchoolClass\EditController;
use App\Http\Controllers\SchoolClass\StoreController;
use App\Http\Controllers\SchoolClass\UpdateController;
use App\Http\Controllers\SchoolClass\DestroyController;
use Illuminate\Support\Facades\Route;
 
Route::get('/', function () {
    return view('welcome');
});
 
Route::name('students.')->prefix('students')->group(function () {
 
    // Halaman Daftar Siswa
    Route::get('/', [StudentController::class, 'index'])->name('index');
 
    // Halaman Tambah Siswa
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    
    // Halaman Detail Siswa
    Route::get('/{id}', [StudentController::class, 'show'])->name('show');
 
    // Halamann Edit Siswa
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');
 
    // Logika Tambah Siswa
    Route::post('/', [StudentController::class, 'store'])->name('store');
 
    // Logika Edit Siswa
    Route::put('/{id}', [StudentController::class, 'update'])->name('update');
 
    // Logika Hapus Siswa
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('destroy');
});
 
Route::name('teachers.')->prefix('teachers')->group(function () {
 
    // Halaman Daftar Guru
    Route::get('/', [TeacherController::class, 'index'])->name('index');
 
    // Halaman Detail Guru
    Route::get('/{id}', [TeacherController::class, 'show'])->name('show');
 
    // Halaman Tambah Guru
    Route::get('/create', [TeacherController::class, 'create'])->name('create');
 
    // Halamann Edit Guru
    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit');
 
    // Logika Tambah Guru
    Route::post('/', [TeacherController::class, 'store'])->name('store');
 
    // Logika Edit Guru
    Route::put('/{id}', [TeacherController::class, 'update'])->name('update');
 
    // Logika Hapus Guru
    Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('destroy');
});
 
Route::resource('majors', MajorController::class);
 
Route::name('classes.')->prefix('classes')->group(function () {
 
    Route::get('/', IndexController::class)->name('index');
 
    Route::get('/{id}', ShowController::class)->name('show');
 
    Route::get('/create', CreateController::class)->name('create');
 
    Route::get('/{id}/edit', EditController::class)->name('edit');
 
    Route::post('/', StoreController::class)->name('store');
 
    Route::put('/{id}', UpdateController::class)->name('update');
 
    Route::delete('/{id}', DestroyController::class)->name('destroy');
 
});