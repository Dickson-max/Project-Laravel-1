<?php

use App\Models\Major;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create(['role' => 'teacher']));
});

test('teacher index page displays teacher status', function () {
    Teacher::factory()->create([
        'name' => 'Budi Santoso',
        'status' => 'Aktif',
    ]);

    $this->get(route('teachers.index'))
        ->assertSuccessful()
        ->assertSee('Daftar Guru')
        ->assertSee('Aktif');
});

test('teacher detail page displays teacher status', function () {
    $teacher = Teacher::factory()->create([
        'name' => 'Budi Santoso',
        'status' => 'Aktif',
    ]);

    $this->get(route('teachers.show', $teacher))
        ->assertSuccessful()
        ->assertSee('Budi Santoso')
        ->assertSee('Aktif');
});

test('major detail and edit pages receive the selected major', function () {
    $major = Major::factory()->create([
        'code' => 'AKL',
        'name' => 'Akuntansi dan Keuangan Lembaga',
    ]);

    $this->get(route('majors.show', $major))
        ->assertSuccessful()
        ->assertSee('Akuntansi dan Keuangan Lembaga')
        ->assertSee('AKL');

    $this->get(route('majors.edit', $major))
        ->assertSuccessful()
        ->assertSee('Akuntansi dan Keuangan Lembaga')
        ->assertSee(route('majors.update', $major), false);
});

test('management forms submit to their store and update routes', function () {
    $major = Major::factory()->create([
        'code' => 'AKL',
        'name' => 'Akuntansi dan Keuangan Lembaga',
    ]);

    $teacher = Teacher::factory()->create();
    $schoolClass = SchoolClass::factory()->create();

    $forms = [
        [route('majors.create'), route('majors.store'), 'POST'],
        [route('majors.edit', $major), route('majors.update', $major), 'PUT'],
        [route('classes.create'), route('classes.store'), 'POST'],
        [route('classes.edit', $schoolClass), route('classes.update', $schoolClass), 'PUT'],
        [route('teachers.create'), route('teachers.store'), 'POST'],
        [route('teachers.edit', $teacher), route('teachers.update', $teacher), 'PUT'],
    ];

    foreach ($forms as [$page, $action, $method]) {
        $this->get($page)
            ->assertSuccessful()
            ->assertSee($action, false);

    }
});

test('teachers can be created viewed updated and deleted from the database', function () {
    $this->post(route('teachers.store'), [
        'nip' => '199901012024',
        'name' => 'Guru Baru',
        'gender' => 'P',
        'subject' => 'Matematika',
        'phone_number' => '081234567890',
        'status' => 'Aktif',
    ])->assertRedirect(route('teachers.index'));

    $this->assertDatabaseHas('teachers', [
        'nip' => '199901012024',
        'name' => 'Guru Baru',
        'gender' => 'P',
    ]);

    $teacher = Teacher::query()->where('nip', '199901012024')->firstOrFail();

    $this->get(route('teachers.index'))
        ->assertSuccessful()
        ->assertSee('Guru Baru');

    $this->get(route('teachers.show', $teacher))
        ->assertSuccessful()
        ->assertSee('Matematika');

    $this->put(route('teachers.update', $teacher), [
        'nip' => '199901012024',
        'name' => 'Guru Diperbarui',
        'gender' => 'L',
        'subject' => 'Fisika',
        'phone_number' => '081234567891',
        'status' => 'Tidak Aktif',
    ])->assertRedirect(route('teachers.index'));

    $this->assertDatabaseHas('teachers', [
        'id' => $teacher->id,
        'name' => 'Guru Diperbarui',
        'subject' => 'Fisika',
        'status' => 'Tidak Aktif',
    ]);

    $this->delete(route('teachers.destroy', $teacher))
        ->assertRedirect(route('teachers.index'));

    $this->assertDatabaseMissing('teachers', ['id' => $teacher->id]);
});

test('classes can be created viewed updated and deleted from the database', function () {
    $major = Major::factory()->create([
        'code' => 'RPL',
        'name' => 'Rekayasa Perangkat Lunak',
    ]);
    $teacher = Teacher::factory()->create(['name' => 'Wali Kelas']);

    $this->post(route('classes.store'), [
        'name' => 'XI RPL 1',
        'grade' => 'XI',
        'major_id' => $major->id,
        'teacher_id' => $teacher->id,
    ])->assertRedirect(route('classes.index'));

    $this->assertDatabaseHas('classes', [
        'name' => 'XI RPL 1',
        'grade' => 'XI',
        'major_id' => $major->id,
        'teacher_id' => $teacher->id,
    ]);

    $schoolClass = SchoolClass::query()->where('name', 'XI RPL 1')->firstOrFail();

    $this->get(route('classes.index'))
        ->assertSuccessful()
        ->assertSee('XI RPL 1')
        ->assertSee('Rekayasa Perangkat Lunak')
        ->assertSee('Wali Kelas');

    $this->get(route('classes.show', $schoolClass))
        ->assertSuccessful()
        ->assertSee('Rekayasa Perangkat Lunak');

    $this->put(route('classes.update', $schoolClass), [
        'name' => 'XI RPL 2',
        'grade' => 'XI',
        'major_id' => $major->id,
        'teacher_id' => $teacher->id,
    ])->assertRedirect(route('classes.index'));

    $this->assertDatabaseHas('classes', [
        'id' => $schoolClass->id,
        'name' => 'XI RPL 2',
    ]);

    $this->delete(route('classes.destroy', $schoolClass))
        ->assertRedirect(route('classes.index'));

    $this->assertDatabaseMissing('classes', ['id' => $schoolClass->id]);
});

test('teachers, classes, and majors in use cannot be deleted', function () {
    $major = Major::factory()->create(['code' => 'UXD']);
    $teacher = Teacher::factory()->create();
    $schoolClass = SchoolClass::factory()->create([
        'major_id' => $major->id,
        'teacher_id' => $teacher->id,
    ]);

    Student::create([
        'nis' => '9877',
        'name' => 'Siswa Uji',
        'gender' => 'Laki-laki',
        'class_id' => $schoolClass->id,
        'major_id' => $major->id,
    ]);

    $this->delete(route('classes.destroy', $schoolClass))
        ->assertRedirect(route('classes.index'))
        ->assertSessionHas('error');

    $this->delete(route('teachers.destroy', $teacher))
        ->assertRedirect(route('teachers.index'))
        ->assertSessionHas('error');

    $this->delete(route('majors.destroy', $major))
        ->assertRedirect(route('majors.index'))
        ->assertSessionHas('error');

    $this->assertDatabaseHas('classes', ['id' => $schoolClass->id]);
    $this->assertDatabaseHas('teachers', ['id' => $teacher->id]);
    $this->assertDatabaseHas('majors', ['id' => $major->id]);
});

test('majors can be created viewed updated and deleted from the database', function () {
    $this->post(route('majors.store'), [
        'code' => 'bdx',
        'name' => 'Bisnis Ekspor',
        'description' => 'Program untuk bisnis ekspor.',
    ])->assertRedirect(route('majors.index'));

    $this->assertDatabaseHas('majors', [
        'code' => 'BDX',
        'name' => 'Bisnis Ekspor',
        'description' => 'Program untuk bisnis ekspor.',
    ]);

    $major = Major::query()->where('code', 'BDX')->firstOrFail();

    $this->get(route('majors.index'))
        ->assertSuccessful()
        ->assertSee('Bisnis Ekspor')
        ->assertSee('BDX');

    $this->get(route('majors.show', $major))
        ->assertSuccessful()
        ->assertSee('Program untuk bisnis ekspor.');

    $this->put(route('majors.update', $major), [
        'code' => 'BDE',
        'name' => 'Bisnis Digital Ekspor',
        'description' => 'Program yang diperbarui.',
    ])->assertRedirect(route('majors.index'));

    $this->assertDatabaseHas('majors', [
        'id' => $major->id,
        'code' => 'BDE',
        'name' => 'Bisnis Digital Ekspor',
        'description' => 'Program yang diperbarui.',
    ]);

    $this->delete(route('majors.destroy', $major))
        ->assertRedirect(route('majors.index'));

    $this->assertDatabaseMissing('majors', ['id' => $major->id]);
});

test('a major code must be unique and majors used by students cannot be deleted', function () {
    $major = Major::factory()->create([
        'code' => 'TKJ',
        'name' => 'Teknik Komputer dan Jaringan',
    ]);

    $this->from(route('majors.create'))
        ->post(route('majors.store'), [
            'code' => 'tkj',
            'name' => 'Duplikat TKJ',
            'description' => 'Kode yang sudah digunakan.',
        ])
        ->assertRedirect(route('majors.create'))
        ->assertSessionHasErrors('code');

    Student::create([
        'nis' => '9876',
        'name' => 'Siswa Uji',
        'gender' => 'Laki-laki',
        'major_id' => $major->id,
    ]);

    $this->delete(route('majors.destroy', $major))
        ->assertRedirect(route('majors.index'))
        ->assertSessionHas('error');

    $this->assertDatabaseHas('majors', ['id' => $major->id]);
});
