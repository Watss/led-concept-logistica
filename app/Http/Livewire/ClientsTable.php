<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsTable extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        return view('livewire.clients-table', [
            'clients' => Client::paginate(5),
            'search' => $this->search
        ]);
    }
}
