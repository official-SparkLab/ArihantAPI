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
        $product->p_unit = $request->input('p_unit');
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


     //Fetch Particular Product data through id
     public function fetchDataById($p_id)
     {
         $product = Product_Model::find($p_id);
      
         if (!$product) {
             return response()->json([
                 'message' => 'Product not found',
             ], 404);
         }
      
         return response()->json([
             'data' => $product,
         ]);
     }
     



// Update Particular data by id

public function updateProductData(Request $request, $p_id)
{
    $product = Product_Model::find($p_id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->p_name = $request->input('p_name');
    $product->p_unit = $request->input('p_unit');
    $product->p_category = $request->input('p_category');
    $product->p_batch = $request->input('p_batch');
    $product->p_rate = $request->input('p_rate');
    $product->p_note = $request->input('p_note');
    
    $product->save();

    if ($product) {
        return response()->json(['message' => 'Data updated successfully']);
    } else {
        return response()->json(['message' => 'Failed to update data']);
    }
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
