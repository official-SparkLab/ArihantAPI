<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ordered_Product_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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



    // Update Orderd Product
    public function updateOrder(Request $request, $unique_id)
    {
        $product = Ordered_Product_Model::where('unique_id', $unique_id)->first();

        if (!$product) {
            return response()->json(['Message' => 'Product not found']);
        }

        $product->p_id = $request->input('p_id');
        $product->product_name = $request->input('product_name');
        $product->quantity = $request->input('quantity');
        $product->rate = $request->input('rate');
        $product->total = $request->input('total');
        $product->save();

        return response()->json(['Message' => 'Product updated successfully']);
    }



    // Sale product qty of ready to ship , fulfilled, delivered
    public function minusTotalqty()
    {
        $qtyData = DB::select("
                        SELECT op.product_name AS product_name, SUM(op.quantity) AS total_quantity
                FROM tbl_ordered_product op
                LEFT JOIN tbl_order_details od ON od.unique_id = op.unique_id
                WHERE od.order_status = 'Ready to ship' OR od.order_status = 'Fulfilled' OR od.order_status = 'Delivered' OR od.order_status = 'In transit'
                GROUP BY op.product_name;
        ");
    
        $productQuantities = [];
    
        foreach ($qtyData as $entry) {
            $productName = $entry->product_name;
            $totalQuantity = $entry->total_quantity;
    
            $productQuantities[] = ['product_name' => $productName, 'quantity' => $totalQuantity];
        }
    
        return response()->json(['data' => $productQuantities], 200);
    }
    



    // Sale product qty of cancelled and returned
    public function plusTotalqty()
    {
        $qtyData = DB::select("
                        SELECT op.product_name AS product_name, SUM(op.quantity) AS total_quantity
                FROM tbl_ordered_product op
                LEFT JOIN tbl_order_details od ON od.unique_id = op.unique_id
                WHERE od.order_status = 'Cancelled' OR od.order_status = 'Returned'
                GROUP BY op.product_name;
        ");
    
        $productQuantities = [];
    
        foreach ($qtyData as $entry) {
            $productName = $entry->product_name;
            $totalQuantity = $entry->total_quantity;
    
            $productQuantities[] = ['product_name' => $productName, 'quantity' => $totalQuantity];
        }
    
        return response()->json(['data' => $productQuantities], 200);
    }
    








}