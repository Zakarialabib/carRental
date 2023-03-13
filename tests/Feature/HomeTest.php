<?php

declare(strict_types=1);

use function Pest\Laravel\get;

test('home', function () {
    get('/')->assertStatus(200);
});
