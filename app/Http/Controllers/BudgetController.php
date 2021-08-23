<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetStoreRequest;
use App\Models\Budget;
use App\Models\DetailsBudget;

class BudgetController extends Controller
{
    public function store(BudgetStoreRequest $request){
        $budget = Budget::create($request->except('products'));

        $this->storeDetails($request->products, $budget);

        $budget->detailsBudgets;

        return response()->json([
            "success" => true,
            "budget" => $budget,
        ]);
    }

    public function edit(Budget $budget){
        return $budget;
    }

    public function update(BudgetStoreRequest $request, Budget $budget){
        $budget->update($request->except('products'));

        $this->storeDetails($budget,$request->products);

        return response()->json([
            "success" => true,
            "budget" => $budget,
        ]);
    }

    private function storeDetails($products,Budget $budget){
        if($products)
            foreach ($products as $product) {
                $product['budget_id'] = $budget->id;
                DetailsBudget::updateOrCreate($product);
            }
    }
}
