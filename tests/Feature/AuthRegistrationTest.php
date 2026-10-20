<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a user can register with the default student role', function () {
    $this->post(route('register-post'), [
        'name' => 'Siswa Contoh',
        'email' => 'siswa@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect(route('login-view'));

    $this->assertDatabaseHas('users', [
        'email' => 'siswa@example.com',
        'role' => 'student',
    ]);
});
