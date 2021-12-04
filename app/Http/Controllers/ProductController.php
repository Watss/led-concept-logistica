<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{

    use WithFileUploads;

    public $photo;
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
    //    $this->middleware(['role:Administrador'])->except('index');
    }

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
        $this->authorize('create',$product);

        $types = Type::all();

        return view('product.create',compact('product','types'));
    }

    public function update(ProductStoreRequest $request, Product $product){

        $this->authorize($product);

        $target_request = $request->validated();

        if ($request->image) {

            $imageName =  $request->name.'-'.time().'.'.$request->image->extension();

            $path = $imageName ? $request->image->storeAs('public/images', $imageName) :  "" ;

            $target_request['image'] = 'storage/images/'.$imageName;
        }

        $target_request['type_id'] = $request->type_id;

        $product->update($target_request);

        return redirect()->route('products.index');
    }

    /**
     * @param \App\Http\Requests\ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $target_request = $request->validated();

        if ($request->image) {

            $imageName =$request->name.'-'.time().'.'.$request->image->extension();

            $path = $request->image->storeAs('public/images', $imageName);

            $target_request['image'] = 'storage/images/'.$imageName;

        }

        $target_request['type_id'] =  $request->type_id;


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
        $this->authorize('edit',$product);

        $types = Type::all();

        return view('product.edit', compact('product','types'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $this->authorize($product);

        $id = $product->id;
    
        $budgets = $product->detailsBudgets()->get();

        if($request->input('confirm') != "1"){

            return redirect()->route('products.index')
                             ->with('warning','Advertencia. El producto ya está siendo utilizado en la(s) cotización(es).')
                             ->with('budgets',$budgets)
                             ->with('idProducto',$id);
        };
        

        $product->detailsBudgets()->delete();

        $product->delete();

        $budgets->each(function($el){
            $el->budget()->delete();    
        });

        Alert::success('Producto eliminado correctamente');
        return redirect()->route('products.index')->with('message','Producto eliminado correctamente');
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

    public function saveProductJson(ProductStoreRequest $request){
        $target_request = $request->validated();

        if ($request->image) {
            $imageName = $request->name.'-'.time().'.'.$request->image->extension();

            $path = $request->image->storeAs('public/images', $imageName);

            $target_request['image'] = 'storage/images/'.$imageName;
        }


        $target_request['type_id'] =  $request->type_id;

        $product = Product::create($target_request);

        return $product;
    }
}
