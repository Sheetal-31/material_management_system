<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MaterialController extends Controller
{
    /**
     * Display a listing of the materials.
     */
    public function index(): View
    {
        $materials = Material::with('category')
            ->where('is_active', true)
            ->get();
        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new material.
     */
    public function create(): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('materials.create', compact('categories'));
    }

    /**
     * Store a newly created material in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'opening_balance' => 'required|numeric|min:0|regex:/^\d*(\.\d{1,2})?$/'
        ]);

        Material::create($validated);

        return redirect()->route('materials.index')
            ->with('success', 'Material created successfully.');
    }

    /**
     * Show the form for editing the specified material.
     */
    public function edit(Material $material): View
    {
        $categories = Category::where('is_active', true)->get();
        return view('materials.edit', compact('material', 'categories'));
    }

    /**
     * Update the specified material in storage.
     */
    public function update(Request $request, Material $material): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'opening_balance' => 'required|numeric|min:0|regex:/^\d*(\.\d{1,2})?$/'
        ]);

        $material->update($validated);

        return redirect()->route('materials.index')
            ->with('success', 'Material updated successfully.');
    }

    /**
     * Soft delete the specified material.
     */
    public function destroy(Material $material): RedirectResponse
    {
        $material->update(['is_active' => false]);

        return redirect()->route('materials.index')
            ->with('success', 'Material deleted successfully.');
    }
} 