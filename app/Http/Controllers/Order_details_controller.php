<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order_details_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Order_details_controller extends Controller
{
    //
    
    public function addOrder(Request $request)
    {
        try {
            // Execute the SQL statement using the DB facade
            $result = DB::statement("CALL order_details(?,?, ?, ?, ?, ?, ?, ?, ?, @order_num)", [
                $request->input('unique_id'),
                $request->input('today'),
                $request->input('order_type'),
                $request->input('contactNo'),
                $request->input('sub_total'),
                $request->input('discount'),
                $request->input('grand_total'),
                $request->input('payment_mode'),
                $request->input('order_status'),
            ]);
    
            if ($result) {
                return response()->json(["Message" => "Order Added"]);
            } else {
                return response()->json(["Message" => "Order Not Added"]);
            }
        } catch (\Exception $e) {
            return response()->json(["Message" => "Error: " . $e->getMessage()]);
        }
    }


    public function updateOrder(Request $request, $unique_id)
    {
        $order = Order_details_model::where('unique_id', $unique_id)->first();
    
        if (!$order) {
            return response()->json(['Message' => 'Order not found']);
        }
    
        $order->today = $request->input('today');
        $order->order_type = $request->input('order_type');
        $order->contactNo = $request->input('contactNo');
        $order->sub_total = $request->input('sub_total');
        $order->discount = $request->input('discount');
        $order->grand_total = $request->input('grand_total');
        $order->payment_mode = $request->input('payment_mode');
        $order->order_status = $request->input('order_status');
    
        $order->save();
    
        return response()->json(['Message' => 'Order updated successfully']);
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
