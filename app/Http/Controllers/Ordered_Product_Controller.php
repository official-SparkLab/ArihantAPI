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
        $product->order_no = $request->input('order_no');
        $product->product_name = $request->input('product_name');
        $product->weight = $request->input('weight');
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
}
