<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Main
    public function home()
    {
        return view('home');
    }

    // Show all products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Showw one product (GET with parametre)
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }


    // POST request
    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect('/products');
    }
}
