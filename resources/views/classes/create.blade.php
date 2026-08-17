@extends('layouts.app')

@section('title', $title)

@section('content')

<a href="{{ route('classes.index') }}" class="text-xs uppercase tracking-[0.15em] text-slate-400 hover:text-[#A16207]">&larr; Kembali ke Daftar Kelas</a>

<div class="mt-3 border border-[#E5E3DB] bg-white p-8">
    <div class="mb-6 border-b border-[#E5E3DB] pb-4">
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Formulir Kelas</p>
        <h1 class="font-display text-2xl font-semibold text-[#16213A]">Tambah Kelas Baru</h1>
    </div>

    <form action="{{ route('classes.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-xs uppercase tracking-[0.1em] text-slate-500 mb-2">Nama Kelas</label>
            <input type="text" name="name" id="name" placeholder="Contoh: XII AKL 1" required
                class="w-full border border-[#E5E3DB] p-3 text-sm focus:border-[#16213A] focus:outline-none">
        </div>

        <div>
            <label for="grade" class="block text-xs uppercase tracking-[0.1em] text-slate-500 mb-2">Angkatan / Tingkat</label>
            <select name="grade" id="grade" required class="w-full border border-[#E5E3DB] p-3 text-sm focus:border-[#16213A] focus:outline-none">
                <option value="">-- Pilih Tingkat --</option>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>
        </div>

        <div>
            <label for="major" class="block text-xs uppercase tracking-[0.1em] text-slate-500 mb-2">Jurusan</label>
            <input type="text" name="major" id="major" placeholder="Contoh: AKL" required
                class="w-full border border-[#E5E3DB] p-3 text-sm focus:border-[#16213A] focus:outline-none">
        </div>

        <div>
            <label for="homeroom_teacher" class="block text-xs uppercase tracking-[0.1em] text-slate-500 mb-2">Wali Kelas</label>
            <input type="text" name="homeroom_teacher" id="homeroom_teacher" placeholder="Nama Wali Kelas" required
                class="w-full border border-[#E5E3DB] p-3 text-sm focus:border-[#16213A] focus:outline-none">
        </div>

        <div class="flex justify-end gap-4 border-t border-[#E5E3DB] pt-6">
            <a href="{{ route('classes.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-500 hover:text-[#16213A]">Batal</a>
            <button type="submit" class="bg-[#16213A] px-6 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">Simpan Kelas</button>
        </div>
    </form>
</div>

@endsection