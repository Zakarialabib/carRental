<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Section;

class Sections extends Component
{
    use WithPagination;

    public $createSectionModal = false;
    public $editSectionModal = false;

    public function createSectionModal()
    {
        $this->createSectionModal = true;
    }

    public function store()
    {

    }

    public function editSectionModal()
    {
        $this->editSectionModal = false;
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function getSectionsProperty()
    {
        return Section::query()->paginate();
    }

    public function render()
    {
        return view('livewire.admin.sections');
    }
}
