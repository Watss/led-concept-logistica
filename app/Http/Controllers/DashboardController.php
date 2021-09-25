<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $users = User::all()->count();
        $products = Product::all()->count();
        $clients = Client::all()->count();
        $budgets = Budget::all()->count();

        $new_users = User::where('created_at', '>=', now()->subDays(15))->count();
        $new_products = Product::where('created_at', '>=', now()->subDays(15))->count();
        $new_clients = Client::where('created_at', '>=', now()->subDays(15))->count();
        $new_budgets = Budget::where('created_at', '>=', now()->subDays(15))->count();


        return view('dashboard',compact('users','products','clients','budgets','new_users','new_products','new_clients','new_budgets'));
    }
}
