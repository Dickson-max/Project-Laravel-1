<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    private array $students = [
        [
            'id' => 1,
            'nis' => '1234',
            'name' => 'Dickson',
            'gender' => 'Laki-laki',
            'class' => 'XII TKJ 2',
            'major' => 'TKJ'
        ],
        [
            'id' => 2,
            'nis' => '3456',
            'name' => 'Aileen',
            'gender' => 'Perempuan',
            'class' => 'XII TKJ 1',
            'major' => 'TKJ'
        ],
    ];

    public function index()
    {   
        $title = 'Sistem Sekolah - Daftar Siswa';

        return view('students.index', [
            'title' => $title,
            'students' => $this->students
        ]);
    }

    public function show(string $id)
    {
        $title = 'Sistem Sekolah - Detail Siswa';
        
        $student = collect($this->students)->firstWhere('id', (int) $id);

        abort_if(! $student, 404, 'Data siswa tidak ditemukan.');

        return view('students.show', [
            'title' => $title,
            'student' => $student
        ]);
    }

    public function create()
    {
        $title = 'Sistem Sekolah - Tambah Siswa Baru';

        return view('students.create', ['title' => $title]);
    }

    public function edit(string $id)
    {
        $title = 'Sistem Sekolah - Ubah Data Siswa';

        $student = collect($this->students)->firstWhere('id', (int) $id);

        abort_if(! $student, 404, 'Data siswa tidak ditemukan.');

        return view('students.edit', [
            'title' => $title,
            'student' => $student
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'major' => 'required',
            'class' => 'required',
        ]);

        // Jika sudah pakai Eloquent Model:
        // Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'major' => 'required',
            'class' => 'required',
        ]);

        // Jika sudah pakai Eloquent Model:
        // $student = Student::findOrFail($id);
        // $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        // Jika sudah pakai Eloquent Model:
        // Student::destroy($id);

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}