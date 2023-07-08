<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchasedProduct;

class PurchasedProductController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'invoice_no' => 'required',
            'p_id' => 'required',
            'product_name' => 'required',
            'unit' => 'required',
            'quantity' => 'required|integer',
            'rate' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        PurchasedProduct::create($validatedData);

        return response()->json(['message' => 'Data saved successfully'], 201);
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
