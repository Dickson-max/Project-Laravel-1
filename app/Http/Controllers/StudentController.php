<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class StudentController extends Controller
{
    public function index()
    {   
        $title = 'Sistem Sekolah - Daftar Siswa';
        $students = [
            [
                'id' => 1,
                'nis' => '1234',
                'name' => 'Dickson',
                'class' => 'XII TKJ 2',
                'major' => 'TKJ'
            ],
            [
                'id' => 2,
                'nis' => '3456',
                'name' => 'Aileen',
                'class' => 'XII TKJ 1 ',
                'major' => 'TKJ'
            ],
            
        ];
        return view('students.index', [
            'title' => $title,
            'students' => $students
        ]);
    }
 
    public function show(string $id)
    {
        $title = 'Sistem Sekolah - Detail Siswa';
        
        return view('students.show', ['title' => $title]);
    }
 
    public function create()
    {
        $title = 'Sistem Sekolah - Tambah Siswa Baru';

        return view('students.create', ['title' => $title]);
    }
 
    public function edit(string $id)
    {
        $title = 'Sistem Sekolah - Ubah Data Siswa';

        return view('students.edit', ['title' => $title]);
    }
 
    public function store(Request $request)
    {
        $title = 'Sistem Sekolah - Catat Siswa Baru';

        return "Melakukan penambahan data siswa baru";
    }
 
    public function update(Request $request, string $id)
    {
        $title = 'Sistem Sekolah - Ubah Data Siswa';

        return "Melakukan perubahan data siswa";
    }
 
    public function destroy(string $id)
    {
        $title = 'Sistem Sekolah - Hapus Data Siswa';

        return "Menghapus data siswa";
    }
}
 