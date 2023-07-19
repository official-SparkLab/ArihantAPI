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
        $order->unique_id = $request->input('unique_id');


        $order->save();

        if($order)
        {
            return response()->json(['message'=>'Weight added successfully']);
        }
        else{
            return response()->json(['message'=>'Faild to add Weight']);
        }
    }


    public function fetchWeight($unique_id)
    {
        $weight = Weight_Model::where('unique_id', $unique_id)->first();
    
        if ($weight) {
            return response()->json(['data' => $weight]);
        } else {
            return response()->json(["Message" => "weight not found"]);
        }
    }


    
}
