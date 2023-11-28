<?php

declare(strict_types=1);

use App\Models\User;
use App\Http\Livewire\Admin\Pages;
use function Pest\Laravel\get;

test('pages can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user)->get('/admin/pages')->assertStatus(200);
});

test('livewire cars list is working', function () {
    $this->withoutExceptionHandling();
    // $this->loginAsAdmin();

    $this->livewire(Pages::class)
        ->assertOk()
        ->assertViewIs('livewire.admin.pages');
});


test('pages does not show', function () {
    $user = User::factory()->create();

    actingAs($user)->get('/admin/pages')->assertStatus(200);
});
