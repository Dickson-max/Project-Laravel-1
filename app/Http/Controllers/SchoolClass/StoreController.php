<?php

namespace App\Http\Controllers\SchoolClass;

use Illuminate\Http\Request;

class StoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return "Melakukan penambahan data kelas baru";
    }
}
