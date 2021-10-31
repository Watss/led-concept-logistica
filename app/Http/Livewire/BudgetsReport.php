<?php

namespace App\Http\Livewire;

use App\Models\Budget;
use App\Models\BudgetStatus;
use Barryvdh\DomPDF\PDF;
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
    public $status;

    function __construct()
    {
        $this->start_date = now()->firstOfMonth()->toDateString();
        $this->end_date = now()->lastOfMonth()->toDateString();
    }

    public function render()
    {
        return view('livewire.budgets-report', [
            'budgets' => Budget::with('client', 'user','statusTrashed')
            ->findByRol()
            ->search($this->search)
            ->dates([$this->start_date, $this->end_date])
            ->status($this->status)
            ->orderBy('created_at', 'desc')->paginate(10),
            'statuses' => BudgetStatus::withTrashed()->get(),
            'search' => $this->search
        ]);
    }

    public function makePdf()
    {
        $budgets=Budget::with('client', 'user','statusTrashed')->findByRol()->search($this->search)->dates([$this->start_date, $this->end_date])->status($this->status)->orderBy('created_at', 'desc')->get();
        $pdf=resolve('dompdf.wrapper');
        $pdf->loadView('reports.budget-pdf',['budgets'=>$budgets,'neto'=>$budgets->sum('neto'),'iva'=>$budgets->sum('iva'),'total'=>$budgets->sum('total')]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Cotizaciones-'.now()->toDateString().'.pdf');

    }


}
