<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        return view('client.clients-table', [
            'clients' => Client::search($this->search)->paginate(10),
            'search' => $this->search
        ]);
    }
}
