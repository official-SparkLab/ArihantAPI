<?php

namespace App\Http\Controllers;

use App\Models\Weight_Model;
use Illuminate\Http\Request;

class Weight_Controller extends Controller
{
    // Weight add api
    public function addWeight(Request $request)
    {
        $order = new Weight_Model;

        $order->order_no = $request->input('order_no');
        $order->weight = $request->input('weight');

        $order->save();

        if($order)
        {
            return response()->json(['message'=>'Weight added successfully']);
        }
        else{
            return response()->json(['message'=>'Faild to add Weight']);
        }
    }

    //Fetch Weight by order no
    public function fetchBarcode($weight)
    {
        $weight = Weight_Model::where('order_no', $weight)->first();
    
        if ($weight) {
            return response()->json(['data' => $weight]);
        } else {
            return response()->json(["Message" => "Weight not found"]);
        }
    }
}
