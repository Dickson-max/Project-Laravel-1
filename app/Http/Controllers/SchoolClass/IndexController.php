<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        return view('classes.index', [
            'title' => 'Sistem Sekolah - Daftar Kelas',
            'classes' => SchoolClass::query()
                ->with(['major:id,code,name', 'teacher:id,name'])
                ->orderBy('name')
                ->get(),
        ]);
    }
}
