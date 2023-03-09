<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Car;

class Cars extends Component
{
    use WithPagination;

    public $createCarModal = false;
    public $editCarModal = false;

    public function createCarModal()
    {
        $this->createCarModal = true;
    }

    public function store()
    {

    }

    public function editCarModal()
    {
        $this->editCarModal = false;
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function getCarsProperty()
    {
        return Car::query()->paginate();
    }

    public function render()
    {
        return view('livewire.admin.cars');
    }
}
