<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        return view('user.users-table', [
            'users' => User::search($this->search)->paginate(5),
            'search' => $this->search
        ]);
    }
}
