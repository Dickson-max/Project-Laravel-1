<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    public function __invoke(StoreSchoolClassRequest $request): RedirectResponse
    {
        SchoolClass::create($request->validated());

        return redirect()->route('classes.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }
}
