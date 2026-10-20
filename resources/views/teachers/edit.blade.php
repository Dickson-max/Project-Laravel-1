@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="mb-8 border-b border-[#E5E3DB] pb-5">
            <a href="{{ route('teachers.index') }}" class="text-xs uppercase tracking-[0.15em] text-slate-400 hover:text-[#A16207]">&larr; Daftar Guru</a>
            <h1 class="font-display mt-2 text-3xl font-semibold text-[#16213A]">Ubah Data Guru</h1>
            <p class="mt-1 text-sm text-slate-500">Memperbarui catatan atas nama <span
                    class="font-medium text-[#16213A]">{{ $teacher->name }}</span>.</p>
        </div>

        <form action="{{ route('teachers.update', $teacher) }}" method="POST" class="space-y-6 border border-[#E5E3DB] bg-white p-8">
            @csrf
            @method('PUT')
            <div>
                <label for="nip"
                    class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">NIP</label>
                <input type="text" id="nip" name="nip" value="{{ old('nip', $teacher->nip) }}"
                    class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm focus:border-[#A16207] focus:bg-white focus:outline-none">
                @error('nip')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="name"
                    class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">Nama
                    Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $teacher->name) }}"
                    class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm focus:border-[#A16207] focus:bg-white focus:outline-none">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="gender"
                    class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">Jenis
                    Kelamin</label>
                <select id="gender" name="gender"
                    class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm focus:border-[#A16207] focus:bg-white focus:outline-none">
                    <option value="L" @selected(old('gender', $teacher->gender) === 'L')>Laki-laki</option>
                    <option value="P" @selected(old('gender', $teacher->gender) === 'P')>Perempuan</option>
                </select>
                @error('gender')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="subject"
                    class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">Mata Pelajaran</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject', $teacher->subject) }}"
                class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:border-[#A16207] focus:bg-white focus:outline-none">
                @error('subject')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="phone_number"
                    class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">No. Telepon</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $teacher->phone_number) }}"
                    class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm focus:border-[#A16207] focus:bg-white focus:outline-none">
                @error('phone_number')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="status"
                    class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">Status</label>
                <select id="status" name="status"
                    class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm focus:border-[#A16207] focus:bg-white focus:outline-none">
                    <option value="Aktif" @selected(old('status', $teacher->status) === 'Aktif')>Aktif</option>
                    <option value="Tidak Aktif" @selected(old('status', $teacher->status) === 'Tidak Aktif')>Tidak Aktif</option>
                </select>
                @error('status')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-4 border-t border-[#EFEDE6] pt-6">
                <a href="{{ route('teachers.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-500 hover:text-[#16213A]">Batal</a>
                <button type="submit"
                    class="bg-[#16213A] px-6 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">Perbarui
                    Catatan</button>
            </div>
        </form>

@endsection