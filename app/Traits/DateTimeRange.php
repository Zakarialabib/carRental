<?php

namespace App\Traits;

use DateTime;

trait DateTimeRange
{
    public function getTimeRange(DateTime $startDateTime, DateTime $endDateTime, int $intervalMinutes = 30): array
    {
        $range = [];
        $currentDateTime = clone $startDateTime;
        while ($currentDateTime <= $endDateTime) {
            $range[] = $currentDateTime->format('Y-m-d H:i:s');
            $currentDateTime->add(new DateInterval('PT' . $intervalMinutes . 'M'));
        }
        return $range;
    }
}
