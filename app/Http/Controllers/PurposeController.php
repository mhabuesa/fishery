<?php

namespace App\Http\Controllers;

use App\Models\Purpose;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurposeController extends Controller
{
    public function index()
    {
        $purposes = Purpose::all();
        return view("backend.purpose.index", compact("purposes"));
    }

    public function checkSlug(Request $request)
    {
        $slug = $request->slug;
        $id = $request->id;

        $originalSlug = $slug;
        $counter = 1;

        while (
            Purpose::where('slug', $slug)
            ->when($id, fn($query) => $query->where('id', '!=', $id))
            ->exists()
        ) {
            $slug = $originalSlug . '_' . $counter;
            $counter++;
        }

        return response()->json([
            'slug' => $slug
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:purposes,name',
            'slug' => 'required|string|max:255|unique:purposes,slug',
        ]);

        Purpose::create($request->only('name', 'slug'));

        return redirect()->back()->with('success', 'Purpose added successfully.');
    }

    public function edit(Request $request, $id)
    {
        $purpose = Purpose::findOrFail($id);
        return view("backend.purpose.edit", compact("purpose"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:purposes,name,' . $id,
            'slug' => 'required|string|max:255|unique:purposes,slug,' . $id,
        ]);

        $purpose = Purpose::findOrFail($id);
        $purpose->update($request->only('name', 'slug'));

        return redirect()->route('purpose.index')->with('success', 'Purpose updated successfully.');
    }


    public function destroy(string $id)
    {
        $purpose = Purpose::findOrFail($id);

        try {
            $purpose->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Purpose Deleted Successfully'], 200);
    }
}