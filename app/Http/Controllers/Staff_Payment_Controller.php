<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Staff_Payment_Model;
use Illuminate\Http\Request;

class Staff_Payment_Controller extends Controller
{
    public function addStaffPayment(Request $request)
    {
        $payment = new Staff_Payment_Model;
        $payment->p_name = $request->input('p_name');
        $payment->p_date = $request->input('p_date');
        $payment->p_salary_type = $request->input('p_salary_type');
        $payment->p_salary_amt = $request->input('p_salary_amt');
        $payment->p_deduction = $request->input('p_deduction');
        $payment->p_description = $request->input('p_description');
        
        $payment->save();

        if ($payment) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }

    }

     //Fetch data from database
     public function fetchStaffPaymentData()
     {
         $payment = Staff_Payment_Model::all();
 
         return response()->json([
             'data' => $payment,
         ]);
     }


      // Delete Product data 
    public function deleteStaffPaymentData($p_id)
    {
        $payment = Staff_Payment_Model::findOrFail($p_id);

        $payment->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $payment->save();
    
        return response()->json([
            'message' => 'Payment deleted',
        ]);
    }
}
