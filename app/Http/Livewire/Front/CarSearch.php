<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Car;
use Livewire\Component;

class CarSearch extends Component
{
    public $brand;
    public $search;
    public $minPrice;
    public $maxPrice;
    public $startDate;
    public $endDate;

    public function render()
    {
        $cars = Car::query();

        $query = Car::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->brand) {
            $query->where('brand', $this->brand);
        }

        if ($this->minPrice) {
            $query->where('price', '>=', $this->minPrice);
        }

        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }

        if ($this->startDate && $this->endDate) {
            $start = Carbon::parse($this->startDate)->startOfDay();
            $end = Carbon::parse($this->endDate)->endOfDay();
            $query->whereDoesntHave('bookings', function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end])
                  ->orWhere(function ($q) use ($start, $end) {
                      $q->where('start_date', '<', $start)
                        ->where('end_date', '>', $end);
                  });
            });
        }
        
        $cars = $cars->get();

        return view('livewire.front.car-search', compact('cars'));
    }
}
