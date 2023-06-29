<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enquiry_Model;
use Illuminate\Http\Request;

class Enquiry_Controller extends Controller
{
    // //Add data to database
     public function addEnquiry(Request $request)
     {
         $enquiry = new Enquiry_Model;
         $enquiry->e_name = $request->input('e_name');
         $enquiry->e_mobile_no = $request->input('e_mobile_no');
         $enquiry->e_date = $request->input('e_date');
         $enquiry->e_village = $request->input('e_village');
         $enquiry->product_name = $request->input('e_product_name');
        
         $enquiry->e_note = $request->input('e_note');
         $enquiry->save();
 
         if ($enquiry) {
             return response()->json(['message' => 'Data Added Succesfully']);
         } else {
             return response()->json(['message' => 'Failed to store data']);
         }
     }
 
 
      //Fetch data from database
      public function fetchEnquiryData()
      {
          $customer = Enquiry_Model::all();
  
          return response()->json([
              'data' => $customer,
          ]);
      }


      //Fetch Particular  data through id
  public function fetchDataById($e_id)
  {
      $enquiry = Enquiry_Model::find($e_id);
   
      if (!$enquiry) {
          return response()->json([
              'message' => 'Enquiry not found',
          ], 404);
      }
   
      return response()->json([
          'data' => $enquiry,
      ]);
  }


  // Update Data

    public function updateEnquiry(Request $request,$e_id)
    {

        $enquiry = Enquiry_Model::find($e_id);

        if (!$enquiry) {
            return response()->json(['message' => 'Enquiry not found'], 404);
        }

       
        $enquiry->e_name = $request->input('e_name');
        $enquiry->e_mobile_no = $request->input('e_mobile_no');
        $enquiry->e_date = $request->input('e_date');
        $enquiry->e_village = $request->input('e_village');
        $enquiry->product_name = $request->input('e_product_name');
        $enquiry->e_note = $request->input('e_note');
        $enquiry->save();

        if ($enquiry) {
            return response()->json(['message' => 'Data Updated Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }

 
 
         // Delete Expense data 
     public function deleteEnquiryData($e_id)
     {
         $customer = Enquiry_Model::findOrFail($e_id);
         $customer->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
         $customer->save();
     
         return response()->json([
             'message' => 'Record deleted',
         ]);
     }


     //Add Reason

     public function addReason(Request $request, $e_id)
     {
         $enquiry = Enquiry_Model::find($e_id);
     
         if (!$enquiry) {
             return response()->json(['message' => 'Enquiry not found'], 404);
         }
         
         $enquiry->e_reason = $request->input('e_reason');
         $enquiry->status = 0;
         
         try {
             $enquiry->save();
         } catch (\Exception $e) {
             return response()->json(['message' => 'Failed to update data'], 500);
         }
     
         return response()->json(['message' => 'Data updated successfully'], 200);
     }
     
}
