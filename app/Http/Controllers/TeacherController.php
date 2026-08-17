<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private array $teachers = [
        [
            'id' => 1,
            'nip' => '198501012024',
            'name' => 'Budi Santoso',
            'gender' => 'Laki-Laki',
            'subject' => 'Akuntansi Dasar',
            'phone_number' => '081234560001',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'nip' => '198703152024',
            'name' => 'Siti Aminah',
            'gender' => 'Perempuan',
            'subject' => 'Jaringan Komputer',
            'phone_number' => '081234560002',
            'status' => 'Aktif'
        ]
    ];

    public function index()
    {   
        $title = 'Sistem Sekolah - Daftar Guru';

        return view('teachers.index', [
            'title' => $title,
            'teachers' => $this->teachers
        ]);
    }

    public function create()
    {
        $title = 'Sistem Sekolah - Tambah Guru Baru';

        return view('teachers.create', ['title' => $title]);
    }

    public function show(string $id)
    {
        $title = 'Sistem Sekolah - Detail Guru';
        
        // Cari data guru berdasarkan id, ambil index pertama jika tidak ketemu
        $teacher = collect($this->teachers)->firstWhere('id', (int) $id) ?? $this->teachers[0];

        return view('teachers.show', [
            'title' => $title,
            'teacher' => $teacher
        ]);
    }

    public function edit(string $id)
    {
        $title = 'Sistem Sekolah - Ubah Data Guru';

        // Cari data guru berdasarkan id, ambil index pertama jika tidak ketemu
        $teacher = collect($this->teachers)->firstWhere('id', (int) $id) ?? $this->teachers[0];

        return view('teachers.edit', [
            'title' => $title,
            'teacher' => $teacher
        ]);
    }

    public function store(Request $request) 
    {
        return "Melakukan penambahan data guru";
    }

    public function update(Request $request, string $id) 
    {
        return "Melakukan perubahan data guru";
    }

    public function destroy(string $id) 
    {
        return "Menghapus data guru";
    }
}