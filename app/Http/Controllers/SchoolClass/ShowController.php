<?php

namespace App\Http\Controllers\SchoolClass;

use Illuminate\Http\Request;

class ShowController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $id)
    {
        return "Menampilkan detail kelas dengan ID : {$id}";
    }
}
