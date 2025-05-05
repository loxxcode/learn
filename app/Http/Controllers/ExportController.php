<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Models\Import;
use App\Models\Product;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index(){
        return view("export.index", [
            "export" => Export::with(["products", "imports"])->get(),
            "product" => Product::all(),
        ]);
    }
    public function create(){
        return view("export.create", [
            "import" => Import::with("products")->get(),
            "product"=> Product::all()
        ]);
    }
    public function store(Request $request){
        $request->validate([
            "product_id" => "required",
            "quantity" => "required|decimal:0,2",
            "price" => "required|numeric",
            "description" => "nullable",
        ]);
        $check = Export::where("product_id", "=", $request->product_id)->first();
        if($check){
            $updt = Import::where("product_id", "=", $request->product_id)->first();
            if($updt){
                if ($updt->quantity >= $request->quantity) {
                    $check->product_id = $request->product_id;
                    $check->quantity = $check->quantity + $request->quantity;
                    $check->price = $request->price;
                    $check->total_price =$check->price * $check->quantity;
                    $check->description = $request->description;
                    $check->update();
                    return redirect("/export")->with("success","Data is Updated successfully");
                }
                else{
                    return back()->with("error","Quantity you export is greater than imported");
                }
            }
            else{
                return back()->with("error","import is undefined");
            }
        }
        else{
            $updt = Import::where("product_id", "=", $request->product_id)->first();
            if($updt){
                if ($updt->quantity >= $request->quantity) {
                    $export = new Export();
                    $export->product_id = $request->product_id;
                    $export->quantity = $request->quantity;
                    $export->price = $request->price;
                    $export->total_price = $request->quantity * $request->price;
                    $export->description = $request->description;
                    $export->save();
                    return redirect("/export")->with("success","Data is inserted successfully");
                }
                else{
                    return back()->with("error","Quantity you export is greater than imported");
                }
            }
            else{
                return back()->with("error","import is undefined");
            }
        }
    }
    public function edit($id){        
        return view("export.edit",[
            "export" => Export::findOrFail($id),
            "import" => Import::with("products")->get(),
            "product"=> Product::all()
        ]);
    }
    public function update(Request $request, $id){
        $request->validate([
            "product_id" => "required",
            "quantity" => "required|decimal:0,2",
            "price" => "required|numeric",
            "description" => "nullable",
        ]);
        $check = Export::where("product_id", "=", $request->product_id)->first();
        if($check){
            $export = Export::findOrFail($id);
            $export->product_id = $request->product_id;
            $export->quantity = $request->quantity + $check->quantity;
            $export->price = $request->price;
            $export->total_price = $export->quantity * $request->price;
            $export->description = $request->description;
            $export->update();
            return redirect("/export")->with("success","Data is updated Successfully");
        }
    }
    public function destroy($id){
        $check = Export::findOrFail($id);
        $check->delete();
        return redirect("/export")->with("fail","Data is Deleted successfully");
    }


    public function report(Request $request)
    {
        $period = $request->query('period');
        $now = now();

        $query = Product::with(['imports', 'exports']);

        if ($period === 'weekly') {
            $startDate = $now->copy()->startOfWeek();
            $endDate = $now->copy()->endOfWeek();
            
            $query->whereHas('imports', function($q) use ($startDate, $endDate) {
                $q->whereBetween('updated_at', [$startDate, $endDate]);
            })->orWhereHas('exports', function($q) use ($startDate, $endDate) {
                $q->whereBetween('updated_at', [$startDate, $endDate]);
            });
        } 
        elseif ($period === 'monthly') {
            $startDate = $now->copy()->startOfMonth();
            $endDate = $now->copy()->endOfMonth();
            
            $query->whereHas('imports', function($q) use ($startDate, $endDate) {
                $q->whereBetween('updated_at', [$startDate, $endDate]);
            })->orWhereHas('exports', function($q) use ($startDate, $endDate) {
                $q->whereBetween('updated_at', [$startDate, $endDate]);
            });
        }

        $product = $query->get();
        $import = Import::with('products')->get();
        $export = Export::with('products')->get();
        
        return view('report', compact('export', 'import', 'product'));
    }
}
