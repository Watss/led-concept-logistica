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

    public $bugets;
    public $start_date;
    public $end_date;

    function __construct()
    {

        $this->start_date = now()->firstOfMonth()->toDateString();
        $this->end_date = now()->lastOfMonth()->toDateString();
    }

    public function render()
    {
        return view('livewire.budgets-report', [
            'budgets' => Budget::with('client', 'user')->dates([$this->start_date, $this->end_date])->orderBy('created_at', 'desc')->paginate(10),
            'search' => $this->search
        ]);
    }


}
