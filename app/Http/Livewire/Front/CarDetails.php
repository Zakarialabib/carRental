<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Attribute;
use App\Models\Car;
use App\Models\Location;
use App\Models\Review;
use App\Models\Service;
use Livewire\Component;

class CarDetails extends Component
{
    public $car;
    public $location;
    public $services;
    public $selectedService;
    public $attributes;

    public function mount($id)
    {
        $this->car = Car::find($id);
        $this->location = $this->car->location;
        $this->services = $this->car->services;
        $this->attributes = $this->car->attributes;
    }

    public function loadAttributes()
    {
        $this->attributes = $this->car->attributes;
    }

    public function render()
    {
        return view('livewire.front.car-details');
    }
}
