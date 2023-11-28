<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Page;

class Pages extends Component
{
    use WithPagination;
    
    public $createPageModal = false;
    public $editPageModal = false;

    public function createPageModal()
    {
        $this->createPageModal = true;
    }

    public function store()
    {
        //
    }

    public function editPageModal()
    {
        $this->editPageModal = false;
    }

    public function update()
    {
        //
    }
    
    public function delete()
    {
        //
    }

    public function getPagesProperty()
    {
     return Page::query()->paginate();
    }

    public function render()
    {
        return view('livewire.admin.pages');
    }
}
