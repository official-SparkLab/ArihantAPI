<?php

namespace App\Http\Controllers;

use App\Models\Weight_Model;
use Illuminate\Http\Request;

class Weight_Controller extends Controller
{
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
}
