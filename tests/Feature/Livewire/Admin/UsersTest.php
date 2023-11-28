<?php

declare(strict_types=1);

use App\Models\User;
use App\Http\Livewire\Admin\Users;
use function Pest\Laravel\get;

test('users can be rendered', function () {
    $user = User::factory()->create();
    actingAs($user)->get('/admin/users')->assertStatus(200);
    
});

test('livewire cars list is working', function () {
    $this->withoutExceptionHandling();
    // $this->loginAsAdmin();

    $this->livewire(Users::class)
        ->assertOk()
        ->assertViewIs('livewire.admin.users');
});


test('users component is working', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/users');

    $response->assertOk();
});
