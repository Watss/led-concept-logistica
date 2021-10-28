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

    public function render()
    {
        return view('livewire.products-table', [
            'products' => Product::temporary(1)->orderBy('created_at', 'desc')->search($this->search)->paginate(10),
            'search' => $this->search
        ]);
    }

}
