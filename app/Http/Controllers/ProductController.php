<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('product.create');
    }

    /**
     * @param \App\Http\Requests\ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        return redirect()->route('product.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }
}
