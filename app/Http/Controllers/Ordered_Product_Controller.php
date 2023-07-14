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
        $product->quantity = $request->input('quantity');
        $product->rate = $request->input('rate');
        $product->total = $request->input('total');

        $product->save();

        if ($product) {
            return response()->json(['Message' => 'Product saved successfully']);
        } else {
            return response()->json(['Message' => "Product not saved"]);
        }
    }

    public function deleteOrderdProduct($unique_id, $p_id)
    {
        try {
            $product = Ordered_Product_Model::where('unique_id', $unique_id)
                ->where('p_id', $p_id)
                ->first();

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



    public function fetchOrderedProduct($unique_id)
    {
        $products = Ordered_Product_Model::where('unique_id', $unique_id)->get();

        if ($products->isEmpty()) {
            return response()->json(["message" => "Products not found"]);
        } else {
            return response()->json(['data' => $products]);
        }
    }



    public function updateOrder(Request $request, $unique_id)
    {
        $product = Ordered_Product_Model::where('unique_id', $unique_id)->first();
    
        if (!$product) {
            // Product not found, create a new one
            $product = new Ordered_Product_Model();
            $product->unique_id = $unique_id;
        }
    
        // Check if the product ID has changed
        $inputProductId = $request->input('p_id');
        if ($product->p_id !== $inputProductId) {
            // Product ID has changed, create a new record
            
            $product->unique_id = $unique_id;
            $product->p_id = $inputProductId;
            $product->product_name = $request->input('product_name');
            $product->quantity = $request->input('quantity');
            $product->rate = $request->input('rate');
            $product->total = $request->input('total');
            $product->save();
    
            $message = 'New product added successfully';
        } else {
            // Product ID is the same, update the existing record
            $product->product_name = $request->input('product_name');
            $product->quantity = $request->input('quantity');
            $product->rate = $request->input('rate');
            $product->total = $request->input('total');
            $product->save();
    
            $message = 'Product updated successfully';
        }
    
        return response()->json(['Message' => $message]);
    }

    
    





}