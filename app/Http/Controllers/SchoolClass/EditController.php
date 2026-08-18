<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;

class EditController extends Controller
{
    private array $classes = [
        [
            'id' => 1,
            'name' => 'XII AKL 1',
            'grade' => 'XII',
            'major_id' => 1,
            'teacher_id' => 1,
        ],
        [
            'id' => 2,
            'name' => 'XI TKJ 2',
            'grade' => 'XI',
            'major_id' => 2,
            'teacher_id' => 2,
        ],
    ];

    public function __invoke(string $id)
    {
        $schoolClass = collect($this->classes)->firstWhere('id', (int) $id);

        abort_if(! $schoolClass, 404, 'Data kelas tidak ditemukan.');

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

        return view('classes.edit', [
            'title'       => 'Sistem Sekolah - Ubah Data Kelas',
            'schoolClass' => $schoolClass,
            'majors'      => $majors,
            'teachers'    => $teachers,
        ]);
    }
}