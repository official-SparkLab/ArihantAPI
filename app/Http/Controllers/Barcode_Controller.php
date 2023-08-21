<?php

namespace App\Http\Controllers;

use App\Models\Barcode_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Barcode_Controller extends Controller
{

    // Barcode add api
    public function addBarcode(Request $request)
    {
        $order = new Barcode_Model;

        $order->order_no = $request->input('order_no');
        $order->barcode = $request->input('barcode');
        $order->unique_id = $request->input('unique_id');


        $order->save();

        if($order)
        {
            return response()->json(['message'=>'Barcode added successfully']);
        }
        else{
            return response()->json(['message'=>'Failed to add Barcode']);
        }
    }


    public function fetchBarcode($unique_id)
    {
        $barcode = Barcode_Model::where('unique_id', $unique_id)->first();
    
        if ($barcode) {
            return response()->json(['data' => $barcode]);
        } else {
            return response()->json(["Message" => "barcode not found"]);
        }
    }


    public function showOrderDetailsWithBarcode()
    {
        $post = DB::select("
           select * from tbl_order_details left join tbl_add_customer on tbl_order_details.contact_no = tbl_add_customer.c_mobile_no
          left join tbl_order_barcode on tbl_order_details.order_no = tbl_order_barcode.order_no
           where tbl_order_details.contact_no in (select  c_mobile_no from tbl_add_customer)
        ");

        return response()->json([
            "data" => $post
        ]);
    }

  
    
}
