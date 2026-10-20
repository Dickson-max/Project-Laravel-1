<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke(): View
    {
        return view('classes.create', [
            'title' => 'Sistem Sekolah - Tambah Kelas Baru',
            'majors' => Major::query()->orderBy('code')->get(['id', 'code', 'name']),
            'teachers' => Teacher::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }
}
