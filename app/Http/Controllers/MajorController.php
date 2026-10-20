<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('majors.index', [
            'title' => 'Sistem Sekolah - Daftar Jurusan',
            'majors' => Major::query()->orderBy('code')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $title = 'Sistem Sekolah - Tambah Jurusan';

        return view('majors.create', [
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMajorRequest $request): RedirectResponse
    {
        Major::create($request->validated());

        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major): View
    {
        $title = 'Sistem Sekolah - Detail Jurusan';

        return view('majors.show', [
            'title' => $title,
            'major' => $major,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major): View
    {
        $title = 'Sistem Sekolah - Edit Jurusan';

        return view('majors.edit', [
            'title' => $title,
            'major' => $major,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMajorRequest $request, Major $major): RedirectResponse
    {
        $major->update($request->validated());

        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major): RedirectResponse
    {
        if ($major->students()->exists() || $major->schoolClasses()->exists()) {
            return redirect()->route('majors.index')
                ->with('error', 'Jurusan tidak dapat dihapus karena masih digunakan oleh siswa atau kelas.');
        }

        $major->delete();

        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
