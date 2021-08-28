<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       $products= Product::active()->get()->count();
       $clients= Client::all()->count();
       $budgets= Budget::all()->count();
        return view('dashboard',['products'=>$products,'clients'=>$clients,'budgets'=>$budgets]);
    }
}
