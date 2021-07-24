<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersTable extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::where('name', $this->search)->get(),
            'search' => $this->search
        ]);
    }
}
