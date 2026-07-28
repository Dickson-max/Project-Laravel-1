<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class StudentController extends Controller
{
    public function index()
    {
        return "Ini adalah halaman daftar siswa";
    }
 
    public function show(string $id)
    {
        return "Menampilkan detail siswa dengan ID : {$id}";
    }
 
    public function create()
    {
        return "Menampilkan halaman untuk tambah data siswa";
    }
 
    public function edit(string $id)
    {
        return "Menampilkan halaman edit siswa";
    }
 
    public function store(Request $request)
    {
        return "Melakukan penambahan data siswa baru";
    }
 
    public function update(Request $request, string $id)
    {
        return "Melakukan perubahan data siswa";
    }
 
    public function destroy(string $id)
    {
        return "Menghapus data siswa";
    }
}
 