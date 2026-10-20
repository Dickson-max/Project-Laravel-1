<?php

use App\Models\Major;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create(['role' => 'teacher']));
});

test('student index page can be opened', function () {
    $this->get(route('students.index'))
        ->assertSuccessful()
        ->assertSee('Daftar Siswa');
});

test('student pages display their major and class', function () {
    $major = Major::factory()->create(['name' => 'TKJ']);
    $schoolClass = SchoolClass::factory()->create(['name' => 'X TKJ 1']);
    $student = Student::create([
        'nis' => '1234',
        'name' => 'Siswa Contoh',
        'gender' => 'Laki-laki',
        'major_id' => $major->id,
        'class_id' => $schoolClass->id,
    ]);

    $this->get(route('students.index', [
        'major_id' => $major->id,
        'class_id' => $schoolClass->id,
    ]))
        ->assertSuccessful()
        ->assertSee('X TKJ 1')
        ->assertSee('TKJ');

    $this->get(route('students.show', $student))
        ->assertSuccessful()
        ->assertSee('X TKJ 1')
        ->assertSee('TKJ');

    $this->get(route('students.edit', $student))
        ->assertSuccessful()
        ->assertSee('X TKJ 1')
        ->assertSee('TKJ');
});

test('a student can be created', function () {
    $major = Major::factory()->create();
    $schoolClass = SchoolClass::factory()->create();

    $this->post(route('students.store'), [
        'nis' => '1234',
        'name' => 'Siswa Contoh',
        'gender' => 'Laki-laki',
        'major_id' => $major->id,
        'class_id' => $schoolClass->id,
    ])
        ->assertRedirect(route('students.index'));

    $this->assertDatabaseHas('students', [
        'nis' => '1234',
        'name' => 'Siswa Contoh',
        'major_id' => $major->id,
        'class_id' => $schoolClass->id,
    ]);
});

test('a student can be updated without changing their nis', function () {
    $major = Major::factory()->create();
    $schoolClass = SchoolClass::factory()->create();

    $student = Student::create([
        'nis' => '1234',
        'name' => 'Nama Lama',
        'gender' => 'Laki-laki',
        'major_id' => $major->id,
        'class_id' => $schoolClass->id,
    ]);

    $newMajor = Major::factory()->create();
    $newSchoolClass = SchoolClass::factory()->create();

    $this->put(route('students.update', $student), [
        'nis' => '1234',
        'name' => 'Nama Baru',
        'gender' => 'Laki-laki',
        'major_id' => $newMajor->id,
        'class_id' => $newSchoolClass->id,
    ])
        ->assertRedirect(route('students.index'));

    $this->assertDatabaseHas('students', [
        'id' => $student->id,
        'name' => 'Nama Baru',
        'major_id' => $newMajor->id,
        'class_id' => $newSchoolClass->id,
    ]);
});
