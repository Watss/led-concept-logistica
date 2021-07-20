<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::all();

        return view('brand.index', compact('budgets'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('brand.create');
    }

    /**
     * @param \App\Http\Requests\BrandStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreRequest $request)
    {
        $brand = Brand::create($request->validated());

        return redirect()->route('brand.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Brand $brand)
    {
        return view('brand.edit', compact('brand'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brand.index');
    }
}
