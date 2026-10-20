@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="mb-8 border-b border-[#E5E3DB] pb-5">
        <a href="" class="text-xs uppercase tracking-[0.15em] text-slate-400 hover:text-[#A16207]">&larr; Buku
            Induk</a>
        <h1 class="font-display mt-2 text-3xl font-semibold text-[#16213A]">Catat Siswa Baru</h1>
        <p class="mt-1 text-sm text-slate-500">Isi data untuk mendaftarkan siswa ke buku induk.</p>
    </div>

    <form action="{{ route('students.store') }}" method="POST" class="space-y-6 border border-[#E5E3DB] bg-white p-8">
        @csrf

        <div>
            <label for="nis"
                class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">NIS</label>
            <input value="{{ old('nis') }}" type="text" id="nis" name="nis" placeholder="Contoh: 2024010"
                class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:border-[#A16207] focus:bg-white focus:outline-none">
            @error('nis')
                <span class="text-red-500 py-2"> {{ $message }} </span>
            @enderror
        </div>

        <div>
            <label for="name" class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">Nama
                Lengkap</label>
            <input value="{{ old('name') }}" type="text" id="name" name="name" placeholder="Nama lengkap siswa"
                class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:border-[#A16207] focus:bg-white focus:outline-none">
            @error('name')
                <span class="text-red-500 py-2"> {{ $message }} </span>
            @enderror    
        </div>

        <div>
            <label for="gender" class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">Jenis
                Kelamin</label>
            <select id="gender" name="gender"
                class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm focus:border-[#A16207] focus:bg-white focus:outline-none">
                <option value="">Pilih Gender</option>
                <option @selected(old('gender') == 'Laki-laki') value="Laki-laki">Laki-laki</option>
                <option @selected(old('gender') == 'Perempuan') value="Perempuan">Perempuan</option>
            </select>
            @error('gender')
                <span class="text-red-500 py-2"> {{ $message }} </span>
            @enderror
        </div>

        <div>
            <label for="major_id"
                class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">Jurusan</label>
            <select id="major_id" name="major_id"
                class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm focus:border-[#A16207] focus:bg-white focus:outline-none">
                <option value="">Pilih jurusan</option>
                @foreach ($majors as $major)
                    <option @selected(old('major_id') == $major->id) value="{{ $major->id }}">{{ $major->name }}</option>
                @endforeach
            </select>
            @error('major_id')
                <span class="text-red-500 py-2"> {{ $message }} </span>
            @enderror
        </div>

        <div>
            <label for="class_id"
                class="mb-1.5 block text-xs font-semibold uppercase tracking-widest text-[#16213A]">Kelas</label>
            <select id="class_id" name="class_id"
                class="w-full border border-[#D9D6CD] bg-[#FCFBF8] px-3.5 py-2.5 text-sm focus:border-[#A16207] focus:bg-white focus:outline-none">
                <option value="">Pilih kelas</option>
                @foreach ($schoolClasses as $schoolClass)
                    <option @selected(old('class_id') == $schoolClass->id) value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                @endforeach
            </select>
            @error('class_id')
                <span class="text-red-500 py-2"> {{ $message }} </span>
            @enderror
        </div>

        <div class="flex justify-end gap-4 border-t border-[#EFEDE6] pt-6">
            <a href="{{ route('students.index') }}"
                class="px-4 py-2.5 text-sm font-medium text-slate-500 hover:text-[#16213A]">Batal</a>
            <button type="submit"
                class="bg-[#16213A] px-6 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">Simpan
                ke Buku Induk</button>
        </div>
    </form>

@endsection