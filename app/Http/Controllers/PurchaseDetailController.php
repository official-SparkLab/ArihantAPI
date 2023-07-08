<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseDetail;

class PurchaseDetailController extends Controller
{
    public function store(Request $request)
    {
    
        $purchaseDetails = new PurchaseDetail;
        $purchaseDetails->invoice_no = $request->input('invoice_no');
        $purchaseDetails->date = $request->input('date');
        $purchaseDetails->supplier_name = $request->input('supplier_name');
        $purchaseDetails->place_of_supply = $request->input('place_of_supply');
        $purchaseDetails->dispatch_no = $request->input('dispatch_no');
        $purchaseDetails->destination = $request->input('destination');
        $purchaseDetails->shipping_cost = $request->input('shipping_cost');
        $purchaseDetails->sub_total = $request->input('sub_total');
        $purchaseDetails->discount = $request->input('discount');
        $purchaseDetails->grand_total = $request->input('grand_total');

        $purchaseDetails->save();

        if ($purchaseDetails) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
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
