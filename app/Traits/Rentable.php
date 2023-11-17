<?php

namespace App\Traits;

use DateTime;

trait Rentable
{
    public function book(DateTime $startDate, DateTime $endDate)
    {
        $availability = $this->getAvailableAvailability($startDate, $endDate);

        if (!$availability) {
            throw new Exception('No availability found for the selected date range.');
        }

        $timeSlots = $availability->whereBetween('start_time', [$startDate, $endDate])->get();

        if ($timeSlots->count() < 1) {
            throw new Exception('No available time slots found for the selected date range.');
        }

        $totalPrice = $this->calculateTotalPrice($availability->price_per_day, $startDate, $endDate);

        $booking = new Booking([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $totalPrice,
        ]);

        $availability->bookings()->save($booking);

        return $booking;
    }

    public function getAvailableAvailability(DateTime $startDate, DateTime $endDate)
    {
        return $this->availabilities()
            ->where('start_date', '<=', $startDate)
            ->where('end_date', '>=', $endDate)
            ->whereDoesntHave('bookings', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->first();
    }

    public function calculateTotalPrice(float $pricePerDay, DateTime $startDate, DateTime $endDate)
    {
        $days = $startDate->diff($endDate)->days;

        return $pricePerDay * $days;
    }
}
