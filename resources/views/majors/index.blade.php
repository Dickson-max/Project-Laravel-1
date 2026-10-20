@extends('layouts.app')

@section('title', $title)

@section('content')

@if(session('success'))
    <div class="mb-4 border-l-4 border-[#16213A] bg-[#FCFBF8] p-4 text-sm text-[#16213A] shadow-sm">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-4 border-l-4 border-red-600 bg-red-50 p-4 text-sm text-red-700 shadow-sm">
        {{ session('error') }}
    </div>
@endif

<div class="flex items-center justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="text-xs uppercase tracking-[0.2em] text-[#A16207]">Data Program Keahlian</p>
        <h1 class="font-display mt-1 text-3xl font-semibold text-[#16213A]">Daftar Jurusan</h1>
    </div>
    <a href="{{ route('majors.create') }}"
        class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">
        Catat Jurusan Baru
    </a>
</div>

<div class="mt-6 border border-[#E5E3DB] bg-white">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-[#E5E3DB] bg-[#FCFBF8] text-xs uppercase tracking-widest text-[#16213A]">
            <tr>
                <th class="px-6 py-4">Kode</th>
                <th class="px-6 py-4">Nama Jurusan</th>
                <th class="px-6 py-4">Keterangan</th>
                <th class="px-6 py-4 text-right">Tindakan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#EFEDE6]">
            @forelse ($majors as $major)
                <tr class="hover:bg-[#FCFBF8]">
                    <td class="px-6 py-4 font-mono font-medium text-[#16213A]">{{ $major->code }}</td>
                    <td class="px-6 py-4 font-medium text-[#16213A]">{{ $major->name }}</td>
                    <td class="px-6 py-4 text-slate-600 max-w-xs truncate">{{ $major->description }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('majors.show', $major) }}" class="text-xs font-semibold text-[#16213A] hover:underline">Lihat</a>
                            <a href="{{ route('majors.edit', $major) }}" class="text-xs font-semibold text-[#16213A] hover:underline">Ubah</a>
                            <form action="{{ route('majors.destroy', $major) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurusan ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada data jurusan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection