<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('classes.create', [
            'title' => 'Sistem Sekolah - Tambah Kelas Baru'
        ]);
    }
}