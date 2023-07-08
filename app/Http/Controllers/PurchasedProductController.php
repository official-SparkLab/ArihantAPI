<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchasedProduct;

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
            return response()->json(['Message' => 'Product saved successfully']);
        } else {
            return response()->json(['Message' => "Product not saved"]);
        }
    }

    public function fetchall()
{
    $purchasedProducts = PurchasedProduct::all();

    return response()->json($purchasedProducts, 200);
}

public function show($invoice_no)
{
    $purchasedProduct = PurchasedProduct::where('invoice_no', $invoice_no)->first();

    if (!$purchasedProduct) {
        return response()->json(['message' => 'Data not found'], 404);
    }

    return response()->json($purchasedProduct, 200);
}


}
