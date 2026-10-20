<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        return view('teachers.index', [
            'title' => 'Sistem Sekolah - Daftar Guru',
            'teachers' => Teacher::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('teachers.create', [
            'title' => 'Sistem Sekolah - Tambah Guru Baru',
        ]);
    }

    public function show(Teacher $teacher): View
    {
        return view('teachers.show', [
            'title' => 'Sistem Sekolah - Detail Guru',
            'teacher' => $teacher,
        ]);
    }

    public function edit(Teacher $teacher): View
    {
        return view('teachers.edit', [
            'title' => 'Sistem Sekolah - Ubah Data Guru',
            'teacher' => $teacher,
        ]);
    }

    public function store(StoreTeacherRequest $request): RedirectResponse
    {
        Teacher::create($request->validated());

        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): RedirectResponse
    {
        $teacher->update($request->validated());

        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        if ($teacher->schoolClasses()->exists()) {
            return redirect()->route('teachers.index')
                ->with('error', 'Guru tidak dapat dihapus karena masih menjadi wali kelas.');
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
