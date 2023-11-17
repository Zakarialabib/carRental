<?php

declare(strict_types=1);

namespace App\Http\Front\Livewire;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Availability;
use Carbon\Carbon;

class BookingCalendar extends Component
{
    public $startDate;
    public $endDate;
    public $calendarDate;
    public $bookingDates;
    public $selectedTimeSlot;
    public $selectedDate;
    public $availableTimeSlots = [];
    
    protected $listeners = ['bookingCreated' => '$refresh'];

    protected $rules = [
        'startDate' => 'required|date|before_or_equal:endDate',
        'endDate' => 'required|date|after_or_equal:startDate',
        'calendarDate' => 'nullable|date',
        'selectedTimeSlot' => 'nullable',
    ];


    public function mount($carId)
    {
        $this->car = Car::findOrFail($carId);
        $this->startDate = date('Y-m-d');
        $this->endDate = date('Y-m-d', strtotime('+1 day'));
        $this->calendarDate = date('Y-m-d');
    }
    
    public function updatedStartDate()
    {
        $this->validate();
    }

    public function updatedEndDate()
    {
        $this->validate();
    }

    public function updatedCalendarDate()
    {
        $this->selectedTimeSlot = null;
    }
    
    public function book()
    {
        $validatedData = $this->validate();
    
        $booking = new Booking();
        $booking->start_date = $validatedData['startDate'];
        $booking->end_date = $validatedData['endDate'];
        $booking->user_id = Auth::id();
        $booking->car_id = $this->car->id;
        $booking->save();
    
        session()->flash('message', 'Booking created successfully.');
    }
    
    public function selectTimeSlot()
    {
        $this->validate([
            'selectedTimeSlot' => 'required',
        ]);

        $selectedDateTime = Carbon::parse($this->calendarDate . ' ' . $this->selectedTimeSlot);
        $this->selectedDate = $selectedDateTime->format('Y-m-d H:i:s');

        // emit event with selected date time
        $this->emit('bookingCalendarTimeSelected', $this->selectedDate);
    }

    public function getAvailableTimeSlotsProperty()
    {
        // get all availability records within selected date range
        $availabilities = Availability::where('status', 'available')
            ->where('start_date', '<=', $this->calendarDate)
            ->where('end_date', '>=', $this->calendarDate)
            ->get();

        // get already booked time slots for the selected date
        $bookedTimeSlots = Availability::where('status', 'booked')
            ->whereDate('pickup_time', '=', $this->calendarDate)
            ->pluck('pickup_time');

        $availableTimeSlots = [];

        // loop through all availabilities and add available time slots to array
        foreach ($availabilities as $availability) {
            $startTime = Carbon::parse($availability->pickup_time);
            $endTime = Carbon::parse($availability->dropoff_time);
            $interval = CarbonInterval::minutes($availability->duration);
            $timeSlots = CarbonPeriod::create($startTime, $interval, $endTime);

            foreach ($timeSlots as $timeSlot) {
                // check if time slot is already booked
                if (!$bookedTimeSlots->contains($timeSlot->format('Y-m-d H:i:s'))) {
                    $availableTimeSlots[] = $timeSlot->format('g:i A');
                }
            }
        }

        return $availableTimeSlots;
    }

 
    public function render()
    {
        return view('livewire.front.booking-calendar');
    }
}
