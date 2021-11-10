<?php

namespace App\Http\Livewire;

use App\Models\BudgetStatus;
use Livewire\Component;
use Livewire\WithPagination;

class BudgetStatusTable extends Component
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
        return view('livewire.budget-status-table', [
            'budgetsStatus' => BudgetStatus::withTrashed()->paginate(10),
            'search' => $this->search
        ]);
    }
}
