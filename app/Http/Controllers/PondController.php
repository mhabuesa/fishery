<?php

namespace App\Http\Controllers;

use App\Models\Pond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PondController extends Controller
{
    public function index()
    {
        $ponds = Pond::all();
        return view("backend.pond.index", compact("ponds"));
    }

    public function create()
    {
        return view("backend.pond.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'lease_amount' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|string|max:1',
            'note' => 'nullable|string',
        ]);

        Pond::create($request->all());

        return redirect()->route('pond.index')->with('success', 'Pond added successfully.');
    }

    public function show($id)
    {
        $pond = Pond::query()
            ->withSum('incomeTransactions', 'amount')
            ->withSum('expenseTransactions', 'amount')
            ->findOrFail($id);

        $income = $pond->income_transactions_sum_amount;
        $expense = $pond->expense_transactions_sum_amount;

        if($income < $expense) {
            $profit = 0;
        }else {
            $profit = $income - $expense;
        }
        return view("backend.pond.show", compact("pond", "income", "expense", "profit"));
    }

    public function edit(Request $request, $id)
    {
        $pond = Pond::findOrFail($id);
        return view("backend.pond.edit", compact("pond"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'lease_amount' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'nullable|string|max:1',
            'note' => 'nullable|string',
        ]);

        $pond = Pond::findOrFail($id);
        $pond->update($request->all());

        return redirect()->route('pond.index')->with('success', 'Pond updated successfully.');
    }

    public function destroy(string $id)
    {
        $pond = Pond::findOrFail($id);

        try {
            $pond->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Pond Deleted Successfully'], 200);
    }
}