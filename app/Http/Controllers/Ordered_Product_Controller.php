<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ordered_Product_Model;
use Illuminate\Http\Request;

class Ordered_Product_Controller extends Controller
{
    
    public function addOrder(Request $request)
    {
        $product = new Ordered_Product_Model;
        $product->p_id = $request->input('p_id');
        $product->unique_id = $request->input('unique_id');
        $product->product_name = $request->input('product_name');
        $product->quantity= $request->input('quantity');
        $product->rate = $request->input('rate');
        $product->total = $request->input('total');

        $product->save();

        if($product)
        {
            return response()->json(['Message' => 'Product saved successfully']);
        }
        else{
            return response()->json(['Message' =>"Product not saved"]);
        }
    }


    public function deleteOrderdProduct($p_id)
{
    try {
        $product = Ordered_Product_Model::where('p_id', $p_id)->first();
        if ($product) {
            $product->delete();
            return response()->json(['Message' => 'Product deleted successfully']);
        } else {
            return response()->json(['Message' => 'Product not found']);
        }
    } catch (\Exception $e) {
        return response()->json(['Message' => 'Error: ' . $e->getMessage()]);
    }
}


 //Fetch Data based On unique number

 public function fetchOrderedProduct($unique_id)
 {
     $product = Ordered_Product_Model::find($unique_id);
 
     if ($product) {
         return response()->json(['data' => $product]);
     } else {
         return response()->json(["Message" => "Products not found"]);
     }
 }



}
