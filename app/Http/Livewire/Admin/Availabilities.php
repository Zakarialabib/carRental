<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Availabilities extends Component
{

    public $show = false;
    public function show()
    {
        $this->show = true;

    }
    public function save()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.admin.availabilities');
    }
}
