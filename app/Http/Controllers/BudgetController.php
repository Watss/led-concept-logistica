<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetStoreRequest;
use App\Models\Budget;
use App\Models\BudgetStatus;
use App\Models\DetailsBudget;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request as HttpRequest;

class BudgetController extends Controller
{

    public function index(){
        return view('reports.budget-reports');
    }

    public function create(){
        $products = Product::all();
        $statuses = BudgetStatus::all();
        return view('budget.create',compact('products', 'statuses'));
    }

    public function store(BudgetStoreRequest $request){

        $budget = Budget::create($request->except('products'));

        $this->storeDetails( $budget,$request->products);

        $budget->detailsBudgets;

        return response()->json([
            "success" => true,
            "budget" => $budget,
        ]);
    }

    public function edit(Budget $b,$id){


        $products = Product::all();

        $budget = Budget::find($id);

        $statuses = BudgetStatus::all();

        return view('budget.edit',compact('products','id','budget', 'statuses'));
    }

    public function update(HttpRequest $request, Budget $budget){



        $budget->update($request->except('products'));

        $this->storeDetails($budget,$request->products);

        return response()->json([
            "success" => true,
            "budget" => $budget,
        ]);
    }

    public function deleteProduct(HttpRequest $request , $id){


        $product = DetailsBudget::where('product_id',$id);

        return response()->json([
            "success" => $product->delete()
        ]);


    }

    private function storeDetails(Budget $budget,$products){
     
        if($products)
            foreach ($products as $product) {
                $product['budget_id'] = $budget->id;
                DetailsBudget::updateOrCreate(['budget_id' => $budget->id,'product_id' => $product['product_id']],$product);
            }
    }

    public function print(Budget $budget){
        /* return view('budget.pdf_format'); */
        $pdf = PDF::loadView('budget.pdf_format',['budget' => $budget])->setPaper('a4');
        return $pdf->stream();
    }

    public function getBBudget($id){

        $budget =  Budget::find($id) ;

        return response()->json([
            "success" => true,
            "budget" => [
                'status' => $budget->status->id,
                'detail' => $budget,
                'products' => $budget->detailsBudgets()->get()->toArray(),
                'client' => $budget->client
            ]
        ]);
    }

    public function destroy($id){

        $budget = Budget::find($id) ;

        $budget->products()->detach();

        $budget->delete();

        return response()->json([
            "success" => true
        ]);


    }

    public function copy(Budget $budget){

        $clone = $budget->replicate();
        $clone->push();
        $clone->save();

        $budget->detailsBudgets->map( function($product) use ($clone) {
            $newProduct = $product->replicate();
            $newProduct->budget_id = $clone->id;
            $newProduct->save();
            $newProduct->push();
            $newProduct->save();
        });
        return $clone->id;
    }
}
