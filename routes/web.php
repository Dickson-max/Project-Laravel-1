<?php
use App\Htpp\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::name('students.')->prefix('students')->group(function() {
 Route::get('/', [StudentController::class, 'index'])->name('index');

 Route::get('/{id}', [StudentController::class, 'show'])->name('show');
});

