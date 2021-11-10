<?php

namespace App\Http\Livewire;

use App\Models\Budget;
use App\Models\BudgetStatus;
use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsReport extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $searchBudget='';
    public $listClients=[];
    public $clientId;
    public $start_date;
    public $end_date;
    public $status;
    public $name='';
    public $rut='';


    function __construct()
    {
        $this->start_date = now()->firstOfYear()->toDateString();
        $this->end_date = now()->lastOfYear()->toDateString();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.clients-report', [
            'budgets'=>Budget::with('client', 'user','statusTrashed')
                        ->where('client_id',$this->clientId)
                        ->search($this->searchBudget)
                        ->dates([$this->start_date, $this->end_date])
                        ->status($this->status)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10),
            'statuses' => BudgetStatus::withTrashed()->get(),
            'searchBudget' => $this->searchBudget,
        ]);

    }

    public function searchClient(){

        $this->listClients=Client::search($this->search)->take(5)->get();

    }

    public function getBudgets($client){

        $this->clientId=$client['id'];
        $this->listClients=[];
        $this->name=$client['name'];
        $this->rut=$client['rut'];
    }

    public function makePdf()
    {
        $budgets=Budget::with('client', 'user','statusTrashed')
        ->where('client_id',$this->clientId)
        ->search($this->search)
        ->dates([$this->start_date, $this->end_date])
        ->status($this->status)
        ->orderBy('created_at', 'desc')
        ->get();

        $pdf=resolve('dompdf.wrapper');
        $pdf->loadView('reports.budget-pdf',['budgets'=>$budgets,'neto'=>$budgets->sum('neto'),'iva'=>$budgets->sum('iva'),'total'=>$budgets->sum('total')]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Cotizaciones-'.now()->toDateString().'.pdf');

    }


}
