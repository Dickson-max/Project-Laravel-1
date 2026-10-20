<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{
    public function __invoke(SchoolClass $schoolClass): RedirectResponse
    {
        if ($schoolClass->students()->exists()) {
            return redirect()->route('classes.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki siswa.');
        }

        $schoolClass->delete();

        return redirect()->route('classes.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
