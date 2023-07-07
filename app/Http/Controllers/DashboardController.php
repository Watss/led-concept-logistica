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
        return view('dashboard');
    }
}
