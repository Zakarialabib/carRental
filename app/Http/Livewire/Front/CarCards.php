<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Car;
use Livewire\WithPagination;

class CarCards extends Component
{
    use WithPagination;
    public function getCarsProperty()
    {
        return Car::select('id','name','model','image')->paginate(5);
    }
    public function render()
    {
        return view('livewire.front.car-cards');
    }
}
