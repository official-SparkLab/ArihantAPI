<?php

namespace App\Http\Controllers;

use App\Models\Sale_Payble_Model;
use Illuminate\Http\Request;

class Sale_Payble_Controller extends Controller
{
    public function addSaleData (Request $request)
    {
        $sale = new Sale_Payble_Model;

        $sale->date = $request->input('date');
        $sale->contact_no = $request->input('contact_no'); 
        $sale->cust_name = $request->input('cust_name');
        $sale->pending_amount = $request->input('pending_amount');
        $sale->paid_amount = $request->input('paid_amount');
        $sale->available_bal = $request->input('available_bal');
        $sale->payment_mode = $request->input('payment_mode');
        $sale->trx_no = $request->input('trx_no');
        $sale->description = $request->input('description');

        $sale->save();

        if ($sale) {
            return response()->json(['message' => 'sale Details Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }


    public function getsaleDetails()
    {
        $sale = Sale_Payble_Model::all();

        return response()->json(["data"=>$sale],200);
    
    }

      //Fetch Data based On contact number

      public function fetchByContact($contact_no)
      {
          $sale = Sale_Payble_Model::where('contact_no', $contact_no)->get();
      
          if ($sale) {
              return response()->json(['data' => $sale]);
          } else {
              return response()->json(["Message" => "Data not found"]);
          }
      }
}
