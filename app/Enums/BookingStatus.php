<?php

declare(strict_types=1);

namespace App\Enums;

enum BookingStatus: string
{

    case DRAFT      = 'draft'; // New booking, before payment processing
    case UNPAID     = 'unpaid'; // Require payment
    case PROCESSING = 'processing'; // like offline - payment
    case CONFIRMED  = 'confirmed'; // after processing -> confirmed (for offline payment)
    case COMPLETED  = 'completed'; //
    case CANCELLED  = 'cancelled';
    case PAID       = 'paid'; //
    case PARTIAL_PAYMENT       = 'partial_payment'; //

}
