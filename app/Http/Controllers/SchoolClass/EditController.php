<?php

namespace App\Http\Controllers\SchoolClass;

use Illuminate\Http\Request;

class EditController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
         return "Menampilkan halaman edit kelas";
    }
}
