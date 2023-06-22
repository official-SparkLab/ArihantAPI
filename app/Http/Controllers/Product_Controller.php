<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product_Model;
use Illuminate\Http\Request;

class Product_Controller extends Controller
{
    public function addProduct(Request $request)
    {
        $product = new Product_Model;
        $product->p_name = $request->input('p_name');
        $product->p_category = $request->input('p_category');
        $product->p_batch = $request->input('p_batch');
        $product->p_rate = $request->input('p_rate');
        $product->p_note = $request->input('p_note');
        
        $product->save();

        if ($product) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }

    }

     //Fetch data from database
     public function fetchProducData()
     {
        $product = Product_Model::where('status', 1)->get();
 
         return response()->json([
             'data' => $product,
         ]);
     }


      // Delete Product data 
    public function deleteProductData($p_id)
    {
        $product = Product_Model::findOrFail($p_id);
    
        $product->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $product->save();
    
        return response()->json([
            'message' => 'Product deleted',
        ]);
    }


}
