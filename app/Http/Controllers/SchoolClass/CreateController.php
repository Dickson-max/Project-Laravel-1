<?php

namespace App\Http\Controllers\SchoolClass;

use Illuminate\Http\Request;

class CreateController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
         return "Menampilkan halaman untuk tambah data kelas";
    }
}
