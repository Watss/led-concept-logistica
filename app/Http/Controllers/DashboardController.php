<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Client;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       $now= Carbon::createFromFormat('Y-m-d H:i:s', now()->toDateString(). '00:00:00')->toDateTimeString();
       $products= Product::active()->get()->count();
       $clients= Client::all()->count();
       $budgets= Budget::whereDate('created_at',$now)->get();

       $budgetAcept=$budgets->where('budget_statuses_id',1)->count();
       $budgetRejected=$budgets->where('budget_statuses_id',2)->count();

        return view('dashboard',['products'=>$products,'clients'=>$clients,'budgetAcept'=>$budgetAcept,'budgetRejected'=>$budgetRejected]);
    }
}
