<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Staff_Advance_Payment_Model;
use Illuminate\Http\Request;

class Staff_Advance_Payment_Controller extends Controller
{
    
    public function addStaffAdvancedPayment(Request $request)
    {
        $payment = new Staff_Advance_Payment_Model;
        $payment->p_name = $request->input('p_name');
        $payment->p_adv_amt = $request->input('p_adv_amt');
        $payment->p_mode = $request->input('p_mode');
        $payment->p_date = $request->input('p_date');
        $payment->p_description = $request->input('p_description');
        
        $payment->save();

        if ($payment) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }

    }

     //Fetch data from database
     public function fetchStaffAdvancedPaymentData()
     {
         $payment = Staff_Advance_Payment_Model::all();
 
         return response()->json([
             'data' => $payment,
         ]);
     }


      // Delete Product data 
    public function deleteStaffAdvancedPaymentData($p_id)
    {
        $payment = Staff_Advance_Payment_Model::findOrFail($p_id);

        $payment->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $payment->save();
    
        return response()->json([
            'message' => 'Payment deleted',
        ]);
    }
}
