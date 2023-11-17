<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Enums\BookingStatus;

class BookingHistory extends Component
{
    public $bookingStatus;
    public $customerId;
    public $service;

    public function render()
    {
        $bookings = Booking::orderBy('id', 'desc')
                            ->where('status', '!=', BookingStatus::DRAFT);

        if (!empty($this->bookingStatus)) {
            $bookings->where("status", $this->bookingStatus);
        }
        if (!empty($this->customerId)) {
            $bookings->where("customer_id", $this->customerId);
        }
    
        $bookings = $bookings->whereIn('object_model', array_keys(get_bookable_services()))
                             ->paginate(10);

        return view('livewire.admin.booking-history');
    }
}
