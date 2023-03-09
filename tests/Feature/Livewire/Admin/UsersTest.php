<?php

declare(strict_types=1);

use App\Models\User;

test('users component is working', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/users');

    $response->assertOk();
});
