<?php

use App\Http\Livewire\Admin\Cars;
use App\Models\User;

test('cars component is working', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/cars');

    $response->assertOk();
});



it('test cars list if can be rendred', function () {
    $this->withoutExceptionHandling();
    // $this->loginAsAdmin();

    $this->livewire(Cars::class)
        ->assertOk()
        ->assertViewIs('livewire.admin.cars');
});

