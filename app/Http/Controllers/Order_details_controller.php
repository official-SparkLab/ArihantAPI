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

      //Fetch data from database
      public function fetchOrderDetailsData()
      {
          $orders = Order_details_model::all();
      
          return response()->json([
              'data' => $orders,
          ]);
      }
}
