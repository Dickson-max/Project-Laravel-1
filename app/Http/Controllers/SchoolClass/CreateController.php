<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __invoke()
    {
        $majors = [
            ['id' => 1, 'code' => 'AKL', 'name' => 'Akuntansi dan Keuangan Lembaga'],
            ['id' => 2, 'code' => 'TKJ', 'name' => 'Teknik Komputer dan Jaringan'],
            ['id' => 3, 'code' => 'BD',  'name' => 'Bisnis Digital'],
        ];

        $teachers = [
            ['id' => 1, 'name' => 'Budi Santoso, S.Pd.'],
            ['id' => 2, 'name' => 'Siti Aminah, M.Pd.'],
            ['id' => 3, 'name' => 'Rahmat Hidayat, S.T.'],
        ];

        return view('classes.create', [
            'title'    => 'Sistem Sekolah - Tambah Kelas Baru',
            'majors'   => $majors,
            'teachers' => $teachers,
        ]);
    }
}