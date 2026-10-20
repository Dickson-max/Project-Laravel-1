<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    public function __invoke(UpdateSchoolClassRequest $request, SchoolClass $schoolClass): RedirectResponse
    {
        $schoolClass->update($request->validated());

        return redirect()->route('classes.index')->with('success', 'Data kelas berhasil diperbarui.');
    }
}
