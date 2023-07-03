<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order_details_model;
use Illuminate\Http\Request;

class Order_details_controller extends Controller
{
    //
    
    public function addOrder(Request $request)
    {
        $order = new Order_details_model;

 
        $order->order_date = $request->input('today');
        $order->order_type = $request->input('order_type');
        $order->contact_no = $request->input('contactNo');
        $order->sub_total = $request->input('sub_total');
        $order->discount = $request->input('discount');
        $order->grand_total = $request->input('grand_total');
        $order->payment_mode = $request->input('payment_mode');
        $order->order_status = $request->input('order_status');

        $order->save();

        if($order)
        {
            return response()->json(["Message" => "Order Added"]);
        }
        else{
            return response()->json(["Message" => "Order Not Added"]);
        }

    }

      //Fetch data from database
      public function fetchOrderDetailsData()
      {
          $orders = Order_details_model::all();
      
          return response()->json([
              'data' => $orders,
          ]);
      }
}
