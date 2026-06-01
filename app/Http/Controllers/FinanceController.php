<?php

namespace App\Http\Controllers;

use App\Models\Pond;
use App\Models\Purpose;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FinanceController extends Controller
{
    public function investment_index()
    {
        // Logic to fetch and display investment
        $investments = Transaction::where('type', 'investment')->latest()->get();
        return view('backend.finance.investment.index', compact('investments'));
    }
    public function investment_create()
    {
        // Logic to create a new investment
        $partners = User::all();
        return view('backend.finance.investment.create', compact('partners'));
    }

    public function investment_store(Request $request)
    {
        // Logic to store the new investment
        $request->validate([
            'partner' => 'required',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);


        Transaction::create([
            'partner_id' => $request->partner,
            'type' => 'investment',
            'category' => 'partner_investment',
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'note' => $request->note,
        ]);

        return redirect()->route('finance.investment.index')->with('success', 'Investment created successfully.');
    }

    public function investment_edit($id)
    {
        // Logic to edit an existing investment
        $investment = Transaction::findOrFail($id);
        $partners = User::all();
        return view('backend.finance.investment.edit', compact('investment', 'partners'));
    }
    public function investment_update(Request $request, $id)
    {
        // Logic to update an existing investment
        $request->validate([
            'partner' => 'required',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        $investment = Transaction::findOrFail($id);
        $investment->update([
            'partner_id' => $request->partner,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'note' => $request->note,
        ]);

        return redirect()->route('finance.investment.index')->with('success', 'Investment updated successfully.');
    }

    public function investment_destroy($id)
    {
        $investment = Transaction::findOrFail($id);

        try {
            $investment->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Investment deleted successfully'], 200);
    }

    public function expense_index()
    {
        $expenses = Transaction::where('type', 'expense')->latest()->get();
        return view('backend.finance.expense.index', compact('expenses'));
    }

    public function expense_create()
    {
        $purposes = Purpose::all();
        $ponds = Pond::all();
        return view('backend.finance.expense.create', compact('purposes', 'ponds'));
    }

    public function expense_store(Request $request)
    {
        $request->validate([
            'purpose' => 'required',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create([
            'pond_id' => $request->pond,
            'type' => 'expense',
            'purpose_id' => $request->purpose,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'note' => $request->note,
        ]);

        return redirect()->route('finance.expense.index')->with('success', 'Expense created successfully.');
    }

    public function expense_edit($id)
    {
        $expense = Transaction::findOrFail($id);
        $purposes = Purpose::all();
        $ponds = Pond::all();
        return view('backend.finance.expense.edit', compact('expense', 'purposes', 'ponds'));
    }

    public function expense_update(Request $request, $id)
    {
        $request->validate([
            'purpose' => 'required',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        $expense = Transaction::findOrFail($id);
        $expense->update([
            'purpose_id' => $request->purpose,
            'pond_id' => $request->pond,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'note' => $request->note,
        ]);

        return redirect()->route('finance.expense.index')->with('success', 'Expense updated successfully.');
    }

    public function expense_destroy($id)
    {
        $expense = Transaction::findOrFail($id);

        try {
            $expense->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Expense deleted successfully'], 200);
    }
}