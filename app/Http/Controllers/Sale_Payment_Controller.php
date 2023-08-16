<?php

namespace App\Http\Controllers;

use App\Models\Sale_Payment_Model;
use Illuminate\Http\Request;

class Sale_Payment_Controller extends Controller
{
    
    public function addPayment(Request $request)
    {
        $order = new Sale_Payment_Model;

        $order->order_no = $request->input('order_no');
        $order->contact_no = $request->input('contact_no');
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
            return response()->json(['message'=>'Failed to add payment']);
        }
    }


    public function fetchPayment($order_no)
    {
        $payment = Sale_Payment_Model::where('order_no', $order_no)->get();
    
        if ($payment) {
            return response()->json(['data' => $payment]);
        } else {
            return response()->json(["Message" => "Payment history not found"]);
        }
    }

}
