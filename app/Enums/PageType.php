<?php

declare(strict_types=1);

namespace App\Enums;

enum PageType: string
{
    case HOME = '0';
    case ABOUT = '1';
    case CONTACT = '2';
    case CARS = '3';
}
