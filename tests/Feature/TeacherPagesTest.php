<?php

test('teacher index page displays teacher status', function () {
    $this->get(route('teachers.index'))
        ->assertSuccessful()
        ->assertSee('Daftar Guru')
        ->assertSee('Aktif');
});

test('teacher detail page displays teacher status', function () {
    $this->get(route('teachers.show', ['id' => 1]))
        ->assertSuccessful()
        ->assertSee('Budi Santoso')
        ->assertSee('Aktif');
});
