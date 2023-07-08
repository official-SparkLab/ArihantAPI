<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseDetail;

class PurchaseDetailController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'invoice_no' => 'required',
            'date' => 'required|date',
            'supplier_name' => 'required',
            'place_of_supply' => 'required',
            'dispatch_no' => 'required',
            'destination' => 'required',
            'shipping_cost' => 'required|numeric',
            'sub_total' => 'required|numeric',
            'discount' => 'required|numeric',
            'grand_total' => 'required|numeric'
        ]);

        PurchaseDetail::create($validatedData);

        return response()->json(['message' => 'Data saved successfully'], 201);
    }

    public function index()
    {
        $purchaseDetails = PurchaseDetail::all();

        return response()->json($purchaseDetails, 200);
    }

    public function show($invoice_no)
    {
        $purchaseDetail = PurchaseDetail::where('invoice_no', $invoice_no)->first();

        if (!$purchaseDetail) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($purchaseDetail, 200);
    }
}
