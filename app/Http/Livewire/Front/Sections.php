<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Section;
use Livewire\Component;
use App\Enums\PageType;
use App\Models\Car;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

class Sections extends Component
{    
    use WithPagination;

    public $selectedCar;
    public $car;

    public function selectCar($carId): void
    {
        $this->selectedCar = Car::find($carId);
    }

    public function getCarsProperty(): Collection
    {
        return Car::query()->limit(4)->get();
    }

    public function getSectionsProperty(): Collection
    {
        return Section::where('page', PageType::HOME)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.front.sections');
    }
}
