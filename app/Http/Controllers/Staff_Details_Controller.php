<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Staff_Details_Model;
use Illuminate\Http\Request;

class Staff_Details_Controller extends Controller
{
    //Add data to database
    public function addStaff(Request $request)
    {
        $staff = new Staff_Details_Model;
        $staff->s_name = $request->input('s_name');
        $staff->s_dob = $request->input('s_dob');
        $staff->s_address = $request->input('s_address');
        $staff->s_mobile_no = $request->input('s_mobile_no');
        $staff->s_joining_date = $request->input('s_joining_date');
        $staff->s_type = $request->input('s_type');
        $staff->s_designation = $request->input('s_designation');
        $staff->s_salary = $request->input('s_salary');
        $staff->s_bank_name = $request->input('s_bank_name');
        $staff->s_ifsc = $request->input('s_ifsc');
        $staff->s_acc_no = $request->input('s_acc_no');
        $staff->save();

        if ($staff) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }


     //Fetch data from database
     public function fetchStaffData()
     {
         $staff = Staff_Details_Model::all();
 
         return response()->json([
             'data' => $staff,
         ]);
     }



      //Fetch Particular  data through id
  public function fetchDataById($s_id)
  {
      $product = Staff_Details_Model::find($s_id);
   
      if (!$product) {
          return response()->json([
              'message' => 'Employee not found',
          ], 404);
      }
   
      return response()->json([
          'data' => $product,
      ]);
  }

       //Add data to database
    public function updateStaff(Request $request,$s_id)
    {

        $staff = Staff_Details_Model::find($s_id);

        if (!$staff) {
            return response()->json(['message' => 'Staff not found'], 404);
        }
        
        $staff->s_name = $request->input('s_name');
        $staff->s_dob = $request->input('s_dob');
        $staff->s_address = $request->input('s_address');
        $staff->s_mobile_no = $request->input('s_mobile_no');
        $staff->s_joining_date = $request->input('s_joining_date');
        $staff->s_type = $request->input('s_type');
        $staff->s_designation = $request->input('s_designation');
        $staff->s_salary = $request->input('s_salary');
        $staff->s_bank_name = $request->input('s_bank_name');
        $staff->s_ifsc = $request->input('s_ifsc');
        $staff->s_acc_no = $request->input('s_acc_no');
        $staff->save();

        if ($staff) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }

        // Delete Expense data 
    public function deleteStaffData($s_id)
    {
        $staff = Staff_Details_Model::findOrFail($s_id);

        $staff->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $staff->save();
    
        return response()->json([
            'message' => 'Record deleted',
        ]);
    }
}
