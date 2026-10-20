<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;
use App\Models\Major;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {

        $title = 'Sistem Sekolah - Daftar Siswa';
        $search = $request->query('search');
        $classId = $request->query('class_id');
        $majorId = $request->query('major_id');

        $students = Student::query()
            ->select(['id', 'nis', 'name', 'gender', 'class_id', 'major_id'])
            ->with(['schoolClass:id,name', 'major:id,name'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('nis', 'like', "%{$search}%");
                });
            })
            ->when($classId, fn ($query, $classId) => $query->where('class_id', $classId))
            ->when($majorId, fn ($query, $majorId) => $query->where('major_id', $majorId))
            ->paginate(10)
            ->withQueryString();

        $schoolClasses = SchoolClass::query()->orderBy('name')->get(['id', 'name']);
        $majors = Major::query()->orderBy('name')->get(['id', 'name']);

        return view('students.index', [
            'title' => $title,
            'students' => $students,
            'schoolClasses' => $schoolClasses,
            'majors' => $majors,
        ]);
    }

    public function show(Student $student)
    {
        $title = 'Sistem Sekolah - Detail Siswa';
        $student->load(['schoolClass:id,name', 'major:id,name']);

        return view('students.show', [
            'title' => $title,
            'student' => $student,
        ]);
    }

    public function create()
    {
        $title = 'Sistem Sekolah - Tambah Siswa';

        return view('students.create', [
            'title' => $title,
            'schoolClasses' => SchoolClass::query()->orderBy('name')->get(['id', 'name']),
            'majors' => Major::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function edit(Student $student)
    {
        $title = 'Sistem Sekolah - Edit Siswa';
        $student->load(['schoolClass:id,name', 'major:id,name']);

        return view('students.edit', [
            'title' => $title,
            'student' => $student,
            'schoolClasses' => SchoolClass::query()->orderBy('name')->get(['id', 'name']),
            'majors' => Major::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(StoreRequest $request)
    {
        // Validasi
        $validatedRequest = $request->validated();

        // Tambahkan Data ke Database
        Student::create($validatedRequest);

        // Handle if Success
        return redirect()->route('students.index');
    }

    public function update(Student $student, UpdateRequest $request)
    {
        // Validasi
        $validatedRequest = $request->validated();

        // Update Data
        $student->update($validatedRequest);

        // Handle if Success
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        // Delete Data
        $student->delete();

        // Handle if Success
        return redirect()->route('students.index');
    }
}
