<?php

namespace App\Http\Controllers\SchoolClass;

use Illuminate\Http\Request;

class DestroyController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        return "Menghapus data kelas";
    }
}