<?php

declare(strict_types=1);

namespace App\Enums;

enum EnquiryStatus: string
{

    case PENDING      = 'pending'; 
    case COMPLETED     = 'completed'; 
    case CANCEL = 'cancel'; 

}
