<?php

declare(strict_types=1);

namespace App\Enums;

enum Status: string
{
    case ACTIVE = '1';
    case INACTIVE = '0';
}
