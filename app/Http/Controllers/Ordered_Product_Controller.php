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




    // Sale product qty of cancelled and returned
    public function combineData()
{
    $qtyData = DB::select("SELECT product_name, quantity FROM tbl_purchased_product");

    $productQuantities = [];

    foreach ($qtyData as $product) {
        $productName = $product->product_name; // Use -> instead of ['key'] to access object properties
        $quantity = $product->quantity; // Use -> instead of ['key'] to access object properties

        if (isset($productQuantities[$productName])) {
            $productQuantities[$productName] += $quantity;
        } else {
            $productQuantities[$productName] = $quantity;
        }
    }

    $qtyDataReady = DB::select("
        SELECT op.product_name AS product_name, SUM(op.quantity) AS total_quantity
        FROM tbl_ordered_product op
        LEFT JOIN tbl_order_details od ON od.unique_id = op.unique_id
        WHERE od.order_status IN ('Ready to ship', 'Fulfilled', 'Delivered', 'In transit')
        GROUP BY op.product_name;
    ");

    foreach ($qtyDataReady as $entry) {
        $productName = $entry->product_name;
        $totalQuantity = $entry->total_quantity;

        if (array_key_exists($productName, $productQuantities)) {
            $productQuantities[$productName] -= $totalQuantity; // Subtract totalQuantity
        } else {
            $productQuantities[$productName] = -$totalQuantity;
        }
    }

    $combinedData = [];

    foreach ($productQuantities as $productName => $quantity) {
        $combinedData[] = ['product_name' => $productName, 'quantity' => $quantity];
    }

    return response()->json(['data' => $combinedData], 200);
}

    









}