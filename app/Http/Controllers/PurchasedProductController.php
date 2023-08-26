<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedProduct;
use Illuminate\Support\Facades\DB;

class PurchasedProductController extends Controller
{
    public function store(Request $request)
    {
        $product = new PurchasedProduct;
        $product->invoice_no = $request->input('invoice_no');
        $product->p_id = $request->input('p_id');
        $product->product_name = $request->input('product_name');
        $product->unit = $request->input('unit');
        $product->quantity = $request->input('quantity');
        $product->rate = $request->input('rate');
        $product->total = $request->input('total');

        $product->save();

        if ($product) {
            return response()->json(['Message' => 'Purchased Product saved successfully']);
        } else {
            return response()->json(['Message' => "Product not saved"]);
        }
    }

    public function fetchall()
    {
        $purchasedProducts = PurchasedProduct::all();

        return response()->json($purchasedProducts, 200);
    }


    // Fetch total purchased qty
    public function fetchQuantityTotal()
    {
        $data = DB::select("select product_name, quantity from tbl_purchased_product");
    
        $productQuantities = [];
    
        foreach ($data as $entry) {
            $productName = $entry->product_name;
            $quantity = $entry->quantity;
    
            if (array_key_exists($productName, $productQuantities)) {
                $productQuantities[$productName] += $quantity;
            } else {
                $productQuantities[$productName] = $quantity;
            }
        }
    
        return response()->json($productQuantities, 200);
    }
    

    public function show($invoice_no)
    {
        $purchasedProduct = PurchasedProduct::where('invoice_no', $invoice_no)->get();

        if (!$purchasedProduct) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($purchasedProduct, 200);
    }

    public function deletePurchasedProduct($invoice_no, $p_id)
    {
        try {
            $product = PurchasedProduct::where('invoice_no', $invoice_no)
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

    public function updatePurchaseProduct(Request $request, $invoice_no)
    {
        $product = PurchasedProduct::where('invoice_no', $invoice_no)->first();
    
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


}