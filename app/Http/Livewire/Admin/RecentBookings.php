<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use App\Enums\BookingStatus;

class RecentBookings extends Component
{
    public $limit;

    public function mount($limit = 10)
    {
        $this->limit = $limit;
    }

    public function render()
    {
        $bookings = Booking::where('status', '!=', BookingStatus::DRAFT)
                            ->orderBy('id', 'desc')
                            ->limit($this->limit)
                            ->get();

        return view('livewire.admin.recent-bookings');
    }
}
