<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class ProductsTable extends Component
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
        return view('livewire.products-table', [
            'products' => Product::temporary(0)->orderBy('created_at', 'desc')->search($this->search)->paginate(5),
            'search' => $this->search
        ]);

    }

}
