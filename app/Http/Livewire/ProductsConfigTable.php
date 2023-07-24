<?php

namespace App\Http\Livewire;

use App\Models\ProductConfig;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsConfigTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        return view('product_config.table', [
            'products' => ProductConfig::search($this->search)->latest()->paginate(10),
            'search' => $this->search
        ]);
    }
}
