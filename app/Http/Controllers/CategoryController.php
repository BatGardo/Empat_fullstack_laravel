<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index(): View
    {
        $categories = Category::with('products')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category
     */
    public function show(Category $category): View
    {
        $category->load('products.tags', 'products.reviews');
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Delete category
     *
     * Remove the specified category from storage
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
