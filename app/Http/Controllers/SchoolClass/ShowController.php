<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\View\View;

class ShowController extends Controller
{
    public function __invoke(SchoolClass $schoolClass): View
    {
        $schoolClass->load(['major:id,code,name', 'teacher:id,name']);

        return view('classes.show', [
            'title' => 'Sistem Sekolah - Detail Kelas',
            'class' => $schoolClass,
        ]);
    }
}
