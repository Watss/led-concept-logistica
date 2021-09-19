<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class ProductController extends Controller
{

    use WithFileUploads;

    public $photo;
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('product.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product = new Product();
        $types = Type::all();

        return view('product.create',compact('product','types'));
    }

    public function update(ProductStoreRequest $request, Product $product){

        $product->update($request->validated());

        return redirect()->route('product.index');
    }

    /**
     * @param \App\Http\Requests\ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $target_request = $request->validated();

        $imageName = $request->name.'-'.time().'.'.$request->image->extension();

        $path = $request->image->storeAs('public/images', $imageName);

        $target_request['image'] = 'images/'.$imageName;

        $target_request['type_id'] = null;


        Product::create($target_request);

        return redirect()->route('products.index')->with('message','Producto creado con éxito');
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

    public function saveImage()
    {

        $this->photo->store('imagesProducts');
    }

    public function searchProduct(Request $request){
        $products = Product::Search($request->search)->Temporary(false)->orderBy('name', 'asc')->get();
        return response()->json([
            "success" => true,
            "products" => $products
        ]);
    }
}
