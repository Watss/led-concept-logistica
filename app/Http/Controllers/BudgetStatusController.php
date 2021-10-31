<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetStatusStoreRequest;
use App\Models\BudgetStatus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BudgetStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index',new BudgetStatus());

        return view('budget-status.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $budgetStatus= new BudgetStatus();
        $this->authorize('create',$budgetStatus);
        return view('budget-status.create')->with(["budgetStatus"=>$budgetStatus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetStatusStoreRequest $request)
    {
        $this->authorize('create',new BudgetStatus());
       BudgetStatus::create($request->validated());

       return redirect()->route('budget-status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BudgetStatus $budgetStatus)
    {

        $this->authorize('edit',$budgetStatus);

        return view('budget-status.create',[
            'budgetStatus'=>$budgetStatus
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetStatusStoreRequest $request, BudgetStatus $budgetStatus)
    {
        $this->authorize('update',$budgetStatus);
        $budgetStatus->update($request->validated());
        Alert::success('Actualizado Correctamente');

        return redirect()->route('budget-status.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetStatus $budgetStatus)
    {
        $this->authorize('delete',$budgetStatus);
       if($budgetStatus->id <= 5){
        Alert::delete('No puedes eliminar este estado');
       }
        $budgetStatus->delete();
        Alert::success('Eliminado Correctamente');
        return redirect()->route('budget-status.index');
    }

    public function restore($id)
    {
        $this->authorize('delete',new BudgetStatus());
        $status=BudgetStatus::onlyTrashed()->find($id);
        if ($status) {
            $status->restore();
            Alert::success('Restaurado Correctamente');

        }else{
            Alert::success('Ya se encuentra restaurado!');
        }

        return redirect()->route('budget-status.index');
    }
}
