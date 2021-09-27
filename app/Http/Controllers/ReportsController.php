<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{

    public function index(){

        return view('reports.index');
    }


    public function budgetReport(){

        return view('reports.budget-reports');
    }

    public function clientReport(){

        return view('reports.client-reports');
    }
}
