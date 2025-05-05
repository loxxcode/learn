<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Models\Import;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return view('products.index', ['products' => $products]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        // dd($request -> name);
        $request->validate([
            'name' => 'required|unique:products',
            'description' => 'nullable'
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return redirect(route('product.index'))->with('success', 'Data is Inserted successfully');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        // dd($product);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return redirect(route('product.index'))->with('success', 'Product Update Successfully');
    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect(route('product.index'))->with('fail', 'Product deleted Successfully');
    }

    public function dashboard(){
        $product = Product::all()->count();
        $import = Import::all()->count();
        $export = Export::all()->count();
        return view('dashboard', compact(["product", "import", "export"]));
    }
}
