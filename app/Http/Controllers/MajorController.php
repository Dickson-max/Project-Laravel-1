<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Ini adalah halaman daftar jurusan";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Menampilkan halaman untuk tambah data jurusan";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Melakukan penambahan data jurusan baru";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Menampilkan detail jurusan dengan ID : {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Menampilkan halaman edit jurusan";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Melakukan perubahan data jurusan";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "Menghapus data jurusan";
    }
}
