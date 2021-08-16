<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetStoreRequest;
use App\Models\Budget;
use App\Models\DetailsBudget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function store(BudgetStoreRequest $request){
        $budget = Budget::create($request->except('products'));
        if($request->products){
            foreach ($request->products as $product) {
                $product['budget_id'] = $budget->id;
                DetailsBudget::create($product);
            }
        }
        $budget->detailsBudgets;
        return response()->json([
            "success" => true,
            "budget" => $budget,
        ]);
    }
}
