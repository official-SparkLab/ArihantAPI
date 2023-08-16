<?php

namespace App\Http\Controllers;

use App\Models\Purchase_Payment_Model;
use Illuminate\Http\Request;

class Purchase_Payment_Controller extends Controller
{
    //
    public function addPayment(Request $request)
    {
        $order = new Purchase_Payment_Model;

        $order->invoice_no = $request->input('invoice_no');
        $order->date = $request->input('date');
        $order->paid_amount = $request->input('paid_amount');
        $order->available_bal = $request->input('available_bal');
        $order->payment_mode = $request->input('payment_mode');

        $order->save();

        if($order)
        {
            return response()->json(['message'=>'Payment added successfully']);
        }
        else{
            return response()->json(['message'=>'Failed to add Barcode']);
        }
    }


    public function fetchPayment($invoice_no)
    {
        $payment = Purchase_Payment_Model::where('invoice_no', $invoice_no)->get();
    
        if ($payment) {
            return response()->json(['data' => $payment]);
        } else {
            return response()->json(["Message" => "Payment history not found"]);
        }
    }
}
