<?php

declare(strict_types=1);

use App\Providers\RouteServiceProvider;
use function Pest\Laravel\get;

test('registration screen can be rendered', function () {

    get('/register')->assertStatus(200);

});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name'                  => 'Test User',
        'email'                 => 'test@example.com',
        'phone'                 => '06000000',
        'password'              => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
