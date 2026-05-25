<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function investment_index()
    {
        // Logic to fetch and display investment
        return view('backend.finance.investment.index');
    }
    public function investment_create()
    {
        // Logic to create a new investment
        return view('backend.finance.investment.create');
    }

    public function expense_index()
    {
        // Logic to fetch and display expenses
        return view('backend.finance.expenses.index');
    }
}