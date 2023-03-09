<?php

use App\Models\User;

test('sections component is working', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/admin/sections');

    $response->assertOk();
});
