<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\MaterialTransaction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MaterialTransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index(): View
    {
        $transactions = MaterialTransaction::with(['material.category'])
            ->orderBy('transaction_date', 'desc')
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create(): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'transaction_date' => 'required|date',
            'quantity' => 'required|numeric|regex:/^-?\d*(\.\d{1,2})?$/'
        ]);

        MaterialTransaction::create($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction recorded successfully.');
    }

    /**
     * Get materials by category for AJAX request.
     */
    public function getMaterialsByCategory(Category $category)
    {
        $materials = Material::where('category_id', $category->id)
            ->where('is_active', true)
            ->get(['id', 'name']);
        
        return response()->json($materials);
    }
} 