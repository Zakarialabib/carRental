<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;

class BookingDuration extends Component
{
    public $start_date;
    public $end_date;
    public $durationDays;
    public $durationNights;
    public $durationHours;

    public function mount($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->durationDays = $this->calculateDurationDays();
        $this->durationNights = $this->calculateDurationNights();
        $this->durationHours = $this->calculateDurationHours();
    }

    public function render()
    {
        return view('livewire.booking-duration');
    }

    private function calculateDurationDays()
    {
        $days = max(1, floor((strtotime($this->end_date) - strtotime($this->start_date)) / DAY_IN_SECONDS) + 1);
        return $days;
    }

    private function calculateDurationNights()
    {
        $days = max(1, floor((strtotime($this->end_date) - strtotime($this->start_date)) / DAY_IN_SECONDS));
        return $days;
    }

    private function calculateDurationHours()
    {
        $days = max(1, floor((strtotime($this->end_date) - strtotime($this->start_date)) / HOUR_IN_SECONDS));
        return $days;
    }

}
