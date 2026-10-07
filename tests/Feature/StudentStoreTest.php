<?php

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('student index page can be opened', function () {
    $this->get(route('students.index'))
        ->assertSuccessful()
        ->assertSee('Daftar Siswa');
});

test('a student can be created', function () {
    $this->post(route('students.store'), [
        'nis' => '1234',
        'name' => 'Siswa Contoh',
        'gender' => 'Laki-laki',
        'major' => 'TKJ',
        'class' => 'X TKJ 1',
    ])
        ->assertRedirect(route('students.index'));

    $this->assertDatabaseHas('students', [
        'nis' => '1234',
        'name' => 'Siswa Contoh',
    ]);
});

test('a student can be updated without changing their nis', function () {
    $student = Student::create([
        'nis' => '1234',
        'name' => 'Nama Lama',
        'gender' => 'Laki-laki',
        'major' => 'TKJ',
        'class' => 'X TKJ 1',
    ]);

    $this->put(route('students.update', $student), [
        'nis' => '1234',
        'name' => 'Nama Baru',
        'gender' => 'Laki-laki',
        'major' => 'TKJ',
        'class' => 'XI TKJ 1',
    ])
        ->assertRedirect(route('students.index'));

    $this->assertDatabaseHas('students', [
        'id' => $student->id,
        'name' => 'Nama Baru',
        'class' => 'XI TKJ 1',
    ]);
});
