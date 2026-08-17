<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MajorController extends Controller
{
    private array $majors = [
        [
            'id' => 1,
            'code' => 'AKL',
            'name' => 'Akuntansi dan Keuangan Lembaga',
            'description' => 'Program keahlian yang membekali murid dengan kompetensi pencatatan dan pelaporan keuangan.',
        ],
        [
            'id' => 2,
            'code' => 'TKJ',
            'name' => 'Teknik Komputer dan Jaringan',
            'description' => 'Program keahlian yang membekali murid dengan kompetensi instalasi, konfigurasi, dan pemeliharaan jaringan komputer.',
        ],
        [
            'id' => 3,
            'code' => 'BD',
            'name' => 'Bisnis Digital',
            'description' => 'Program keahlian yang membekali murid dengan kompetensi pemasaran dan pengelolaan bisnis berbasis digital.',
        ],
    ];

    public function index()
    {
        $title = 'Sistem Sekolah - Daftar Jurusan';

        return view('majors.index', [
            'title' => $title,
            'majors' => $this->majors
        ]);
    }

    public function create()
    {
        $title = 'Sistem Sekolah - Tambah Jurusan Baru';

        return view('majors.create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        return redirect()->route('majors.index')->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $title = 'Sistem Sekolah - Detail Jurusan';

        $major = collect($this->majors)->firstWhere('id', (int) $id);

        abort_if(! $major, 404, 'Data jurusan tidak ditemukan.');

        return view('majors.show', [
            'title' => $title,
            'major' => $major
        ]);
    }

    public function edit(string $id)
    {
        $title = 'Sistem Sekolah - Ubah Data Jurusan';

        $major = collect($this->majors)->firstWhere('id', (int) $id);

        abort_if(! $major, 404, 'Data jurusan tidak ditemukan.');

        return view('majors.edit', [
            'title' => $title,
            'major' => $major
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        return redirect()->route('majors.index')->with('success', 'Data jurusan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        return redirect()->route('majors.index')->with('success', 'Data jurusan berhasil dihapus.');
    }
}