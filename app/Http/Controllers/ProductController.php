<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('variants')->get();
        return view('products.index',compact('products'));
    }
    public function create(){
        return view ('products.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|min:2|max:191',
            'description' => 'required',
        ]);

      
        $product = new Product();

        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $extension = $file->extension();
            $fileName = 'product'.time().'.'. $extension;
            $file->storeAs('public/logos', $fileName );
            $product->image= $fileName ;
        }
       

        $product->title = $request->title;
        $product->description = $request->description;
        $product->save();
       
        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $productVariant = new Variant();
                $productVariant->product_id = $product->id;
                $productVariant->variant_name = $variant['name'];
                $productVariant->variant_value = $variant['value'];
                $productVariant->save();
            }
        }

        return redirect()->route('products.index')->with('message', 'Product added successfully.');
    
    }

    public function edit ($id){
        $product =  Product::with('variants')->find(decrypt($id)); 
       
        return view('products.edit',compact('product'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string|min:2|max:191',
            'description' => 'required|string',
           
        ]);

        $product = Product::findOrFail(decrypt($id));

        if ($request->hasFile('logo')) {
            $oldPath = 'public/logos/' . $product->image;
  
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath); 
            }

            $file = $request->file('logo');
            $extension = $file->extension();
            $fileName = 'product' . time() . '.' . $extension;
            $file->storeAs('public/logos', $fileName);
            $product->image = $fileName;
        }

        $product->title = $request->title;
        $product->description = $request->description;
        $product->save();

        // Delete old variants
        Variant::where('product_id', decrypt($id))->delete();

        // Save the new variants
        foreach ($request->variants as $variant) {
            $productVariant = new Variant();
            if($variant['value'] !=''){
                $productVariant->product_id = $product->id;
                $productVariant->variant_name = $variant['name'];
                $productVariant->variant_value = $variant['value'];
                $productVariant->save();
            }
           
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    
    }

    public function destroy($id){
        
        $product =  Product::find($id); 
        if($product){
             $oldPath = 'public/logos/' . $product->image;
             if (Storage::exists($oldPath)) {
                 Storage::delete($oldPath); 
             }
             Variant::where('product_id', $id)->delete();
            $product->delete();
           return response()->json(['status'=>200,'message'=>'Product deleted Successfully']);
          }
          else{
             return response()->json(['status'=>404,'message'=>'Product Not Found']);
          }
    }
}
