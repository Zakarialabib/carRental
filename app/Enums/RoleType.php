<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleType: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
