<?php

namespace App\Http\Livewire;

use App\Models\Budget;
use Livewire\Component;
use Livewire\WithPagination;

class BudgetsReport extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';


    public function render()
    {
        return view('livewire.budgets-report',[
            'products' => Budget::orderBy('created_at', 'desc')->search($this->search)->paginate(10),
            'search' => $this->search
        ]);
    }
}
