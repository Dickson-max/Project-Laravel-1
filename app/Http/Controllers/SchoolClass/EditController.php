<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\View\View;

class EditController extends Controller
{
    public function __invoke(SchoolClass $schoolClass): View
    {
        return view('classes.edit', [
            'title' => 'Sistem Sekolah - Ubah Data Kelas',
            'schoolClass' => $schoolClass,
            'majors' => Major::query()->orderBy('code')->get(['id', 'code', 'name']),
            'teachers' => Teacher::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }
}
