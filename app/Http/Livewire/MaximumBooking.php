<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;

class MaximumBooking extends Component
{
    public $date;
    public $maximumBookings = 10;
    public $currentBookings = 0;

    public function mount($date)
    {
        $this->date = $date;
        $this->currentBookings = $this->checkMaximumBooking($date);
    }

    public function render()
    {
        return view('livewire.maximum-booking');
    }

    private function checkMaximumBooking($date)
    {
        // Implement the logic to check the maximum bookings for the given date
        // and return the current number of bookings.
        // For example:
        // $currentBookings = Booking::where('date', $date)->count();
        $currentBookings = 0;

        if ($currentBookings >= $this->maximumBookings) {
            $this->addError('date', 'The maximum bookings has been reached for this date.');
        }

        return $currentBookings;
    }
}
