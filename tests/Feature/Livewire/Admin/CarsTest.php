<?php

declare(strict_types=1);

use App\Http\Livewire\Admin\Cars;
use App\Models\User;
use function Pest\Laravel\get;

test('cars can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user)->get('/admin/cars')->assertStatus(200);
    
});

test('livewire cars list is working', function () {
    $this->withoutExceptionHandling();
    // $this->loginAsAdmin();

    $this->livewire(Cars::class)
        ->assertOk()
        ->assertViewIs('livewire.admin.cars');
});

test('cars component is working', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/cars');

    $response->assertOk();
});

