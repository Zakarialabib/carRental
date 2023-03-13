<?php

declare(strict_types=1);

use App\Models\User;
use App\Http\Livewire\Admin\Sections;
use function Pest\Laravel\get;

test('sections can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user)->get('/admin/sections')->assertStatus(200);
});

test('livewire cars list is working', function () {
    $this->withoutExceptionHandling();
    // $this->loginAsAdmin();

    $this->livewire(Sections::class)
        ->assertOk()
        ->assertViewIs('livewire.admin.sections');
});


test('sections does not show', function () {
    $user = User::factory()->create();

    actingAs($user)->get('/admin/sections')->assertStatus(200);
});
