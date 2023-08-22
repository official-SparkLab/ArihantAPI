<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseDetail;

class PurchaseDetailController extends Controller
{
    public function store(Request $request)
    {
    
        $purchaseDetails = new PurchaseDetail;
        $purchaseDetails->invoice_no = $request->input('invoice_no');
        $purchaseDetails->date = $request->input('date');
        $purchaseDetails->contact_no = $request->input('contact_no');
        $purchaseDetails->supplier_name = $request->input('supplier_name');
        $purchaseDetails->place_of_supply = $request->input('place_of_supply');
        $purchaseDetails->dispatch_no = $request->input('dispatch_no');
        $purchaseDetails->destination = $request->input('destination');
        $purchaseDetails->destination = $request->input('payment_type');
        $purchaseDetails->shipping_cost = $request->input('shipping_cost');
        $purchaseDetails->sub_total = $request->input('sub_total');
        $purchaseDetails->discount = $request->input('discount');
        $purchaseDetails->grand_total = $request->input('grand_total');
        $purchaseDetails->paid_amount = $request->input('paid_amount');
        $purchaseDetails->available_bal = $request->input('available_bal');
        $purchaseDetails->payment_mode = $request->input('payment_mode');


        $purchaseDetails->save();

        if ($purchaseDetails) {
            return response()->json(['message' => 'Purchase Details Added Succesfully']);
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
        $purchaseDetail = PurchaseDetail::where('invoice_no', $invoice_no)->get();

        if (!$purchaseDetail) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($purchaseDetail, 200);
    }

    public function updatePurchase(Request $request, $invoice_no)
    {
        $order = PurchaseDetail::where('invoice_no', $invoice_no)->first();

        if (!$order) {
            return response()->json(['Message' => 'Purchase not found']);
        }


        $order->date = $request->input('date');
        $order->date = $request->input('payment_type');

        $order->sub_total = $request->input('sub_total');
        $order->discount = $request->input('discount');
        $order->grand_total = $request->input('grand_total');
        $order->paid_amount = $request->input('paid_amount');
        $order->available_bal = $request->input('available_bal');
        $order->payment_mode = $request->input('payment_mode');

        $order->save();

        return response()->json(['Message' => 'Purchase updated successfully']);
    }
}
