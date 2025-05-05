<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Models\Import;
use App\Models\Product;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index(){
        return view("import.index", [
            "import" => Import::with('products')->get(),
            "products" => Product::all()
        ]);
    }
    public function create(){
        return view("import.create",["product"=>Product::all()]);
    }
    public function store(Request $request){
        $request->validate([
            "product_id" => "required",
            "quantity" => "required|decimal:0,2",
            "price" => "required|numeric",
            "description" => "nullable",
        ]);
        $check = Import::where("product_id", "=", $request->product_id)->first();
        if($check){
            $check->quantity = $check->quantity + $request->quantity;
            $check->price = $request->price;
            $check->total_price = $check->quantity * $request->price;
            $check->description = $request->description;
            $check->update();
            return redirect("/import")->with("success","Data is Updated successfully Because is exists");
        }
        else{
            $import = new Import();
            $import->product_id = $request->product_id;
            $import->quantity = $request->quantity;
            $import->price = $request->price;
            $import->total_price = $request->quantity * $request->price;
            $import->description = $request->description;
            $import->save();
            return redirect("/import")->with("success","Data is imported successfully");
        }
    }
    public function edit($id){
        $import = Import::findOrFail( $id );
        $products = Product::findOrFail( $import->product_id );
        $product = Product::all();
        return view("import.edit", compact("import", "product","products"));
    }
    public function update(Request $request, $id){
        $request->validate([
            "product_id"=> "required",
            "quantity"=> "required|decimal:0,2",
            "price"=> "required|numeric",
            "description"=> "nullable",
        ]);
        $import = Import::findOrFail( $id );
        $import->product_id = $request->product_id;
        $import->quantity = $request->quantity;
        $import->price = $request->price;
        $import->total_price = $request->quantity * $request->price;
        $import->description = $request->description;
        $import->update();
        return redirect("/import")->with("success","Data is Updated successfully");
    }
    public function destroy($id){
        $import = Import::findOrFail( $id );
        $export = Export::where("product_id", "=", $import->product_id )->delete();
        $import->delete();
        return redirect("/import")->with("fail","Data is deleted successfully");
    }
}
