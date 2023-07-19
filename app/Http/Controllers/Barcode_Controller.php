<?php

namespace App\Http\Controllers;

use App\Models\Barcode_Model;
use Illuminate\Http\Request;

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

  
    
}
