<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer_Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class Customer_Controller extends Controller
{
    //Add data to database
    public function addCustomer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'c_mobile_no' => 'required|max:10|unique:tbl_add_customer',
            // Add other validation rules for the remaining fields if needed
        ]);

        
    if ($validator->fails()) {
        $errors = $validator->errors();
        $customErrors = [];

        if ($errors->has('c_mobile_no')) {
            $customErrors['c_mobile_no'] = 'The Mobile no has already been taken.';
        }

        // Add custom error messages for other fields if needed

        return response()->json(['errors' => $customErrors], 422);
    }

        $customer = new Customer_Model;
        $customer->c_name = $request->input('c_name');
        $customer->c_mobile_no = $request->input('c_mobile_no');
        $customer->c_email = $request->input('c_email');
        $customer->c_pincode = $request->input('c_pincode');
        $customer->c_state = $request->input('c_state');
        $customer->c_city = $request->input('c_city');
        $customer->c_taluka = $request->input('c_taluka');
        $customer->c_post_office = $request->input('c_post_office');
        $customer->c_village = $request->input('c_village');
        $customer->c_address = $request->input('c_address');
        $customer->c_note = $request->input('c_note');
        $customer->save();

        if ($customer) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }


    //Fetch data from database
    public function fetchCustomersData()
    {
        $customers = Customer_Model::where('status', 1)->get();
    
        return response()->json([
            'data' => $customers,
        ]);
    }


     //Fetch Particular  data through id
  public function fetchDataById($c_id)
  {
      $customer = Customer_Model::find($c_id);
   
      if (!$customer) {
          return response()->json([
              'message' => 'Customer not found',
          ], 404);
      }
   
      return response()->json([
          'data' => $customer,
      ]);
  }
    
    //Fetch Data based On contact number

    public function fetchCustomers($c_mobile_no)
    {
        $customer = Customer_Model::where('c_mobile_no', $c_mobile_no)->first();
    
        if ($customer) {
            return response()->json(['data' => $customer]);
        } else {
            return response()->json(["Message" => "Customer not found"]);
        }
    }
    


    // Delete Expense data 
    public function deleteCustomerData($c_id)
    {
        $customer = Customer_Model::findOrFail($c_id);
        $customer->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $customer->save();

        return response()->json([
            'message' => 'Record deleted',
        ]);
    }


    // Update a customer   
    public function updateCustomer(Request $request, $c_id)
    {
        $customer = Customer_Model::find($c_id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->c_name = $request->input('c_name');
        $customer->c_mobile_no = $request->input('c_mobile_no');
        $customer->c_email = $request->input('c_email');
        $customer->c_pincode = $request->input('c_pincode');
        $customer->c_state = $request->input('c_state');
        $customer->c_city = $request->input('c_city');
        $customer->c_taluka = $request->input('c_taluka');
        $customer->c_post_office = $request->input('c_post_office');
        $customer->c_village = $request->input('c_village');
        $customer->c_address = $request->input('c_address');
        $customer->c_note = $request->input('c_note');
        $customer->save();

        return response()->json(['message' => 'Customer Updated Successfully'], 200);

    }
}