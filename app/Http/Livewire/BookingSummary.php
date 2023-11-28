<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;

class BookingSummary extends Component
{
    public $bookingId;

    public function mount($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function render()
    {
        $booking = Booking::findOrFail($this->bookingId);

        return view('livewire.booking-summary', compact('booking'));
    }
}
