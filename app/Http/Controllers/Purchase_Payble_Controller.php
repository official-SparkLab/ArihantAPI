<?php

namespace App\Http\Controllers;

use App\Models\Purchase_Payble_Model;
use Illuminate\Http\Request;

class Purchase_Payble_Controller extends Controller
{
    public function addPurchaseData (Request $request)
    {
        $purchase = new Purchase_Payble_Model;

        $purchase->date = $request->input('date');
        $purchase->contact_no = $request->input('contact_no'); 
        $purchase->sup_name = $request->input('sup_name');
        $purchase->pending_amount = $request->input('pending_amount');
        $purchase->paid_amount = $request->input('paid_amount');
        $purchase->available_bal = $request->input('available_bal');
        $purchase->payment_mode = $request->input('payment_mode');
        $purchase->trx_no = $request->input('trx_no');
        $purchase->description = $request->input('description');

        $purchase->save();

        if ($purchase) {
            return response()->json(['message' => 'Purchase Details Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }


    public function getPurchaseDetails()
    {
        $purchase = Purchase_Payble_Model::all();

        return response()->json(["data"=>$purchase],200);
    
    }

      //Fetch Data based On contact number

      public function fetchByContact($contact_no)
      {
          $purchase = Purchase_Payble_Model::where('contact_no', $contact_no)->get();
      
          if ($purchase) {
              return response()->json(['data' => $purchase]);
          } else {
              return response()->json(["Message" => "Data not found"]);
          }
      }
}
