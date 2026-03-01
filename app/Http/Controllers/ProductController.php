<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // // Main
    // public function home()
    // {
    //     return view('home');
    // }

    // // Show all products
    // public function index()
    // {
    //     $products = Product::all();
    //     return view('products.index', compact('products'));
    // }

    // // Showw one product (GET with parametre)
    // public function show($id)
    // {
    //     $product = Product::find($id);

    //     if (!$product) {
    //         abort(404);
    //     }

    //     return view('products.show', compact('product'));
    // }


    // // POST request
    // public function store(StoreProductRequest $request)
    // {
    //     Product::create($request->validated());
    //     return redirect('/products');
    // }



        /**
     * Display a listing of products
     */
    public function index(): View
    {
        $products = Product::with('category', 'tags', 'reviews')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created product in storage
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $product = Product::create($validated);

        if ($request->has('tags')) {
            $product->tags()->attach($request->input('tags'));
        }

        return redirect()->route('products.index')->with('success', 'Товар створений успішно!');
    }

    /**
     * Display the specified product
     */
    public function show(Product $product): View
    {
        $product->load('category', 'tags', 'reviews');
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        $product->load('tags');
        return view('products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified product in storage
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $product->update($validated);
        $product->tags()->sync($request->input('tags', []));

        return redirect()->route('products.index')->with('success', 'Товар оновлений успішно!');
    }

    /**
     * Remove the specified product from storage
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Товар видалений успішно!');
    }
}
