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
            'major' => 'AKL',
            'homeroom_teacher' => 'Budi Santoso'
        ],
        [
            'id' => 2,
            'name' => 'XII TKJ 1',
            'grade' => 'XII',
            'major' => 'TKJ',
            'homeroom_teacher' => 'Siti Aminah'
        ]
    ];

    public function __invoke(string $id)
    {
        $class = collect($this->classes)->firstWhere('id', (int) $id) ?? $this->classes[0];

        return view('classes.edit', [
            'title' => 'Sistem Sekolah - Edit Kelas',
            'class' => $class
        ]);
    }
}