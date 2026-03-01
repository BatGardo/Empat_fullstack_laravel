<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews
     */
    public function index(): View
    {
        $reviews = Review::with('product')->paginate(10);
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review
     */
    public function create(): View
    {
        $products = Product::all();
        return view('reviews.create', compact('products'));
    }

    /**
     * Store a newly created review in storage
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        Review::create($validated);
        return redirect()->route('reviews.index')->with('success', 'Review created successfully!');
    }

    /**
     * Display the specified review
     */
    public function show(Review $review): View
    {
        $review->load('product');
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified review
     */
    public function edit(Review $review): View
    {
        $products = Product::all();
        return view('reviews.edit', compact('review', 'products'));
    }

    /**
     * Update the specified review in storage
     */
    public function update(Request $request, Review $review): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        $review->update($validated);
        return redirect()->route('reviews.index')->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified review from storage
     */
    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully!');
    }
}
