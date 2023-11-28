<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    use WithPagination;

    public $createUserModal = false;
    public $editUserModal = false;

    public function createUserModal()
    {
        $this->createUserModal = true;
    }

    public function store()
    {

    }

    public function editUserModal()
    {
        $this->editUserModal = false;
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function getUsersProperty()
    {
        return User::query()->paginate();
    }

    public function render()
    {
        return view('livewire.admin.users');
    }
}
