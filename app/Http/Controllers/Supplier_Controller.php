<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supplier_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Supplier_Controller extends Controller
{
    //Add data to database
    public function addSupplier(Request $request)
    {

        
        $validator = Validator::make($request->all(), [
            's_mobile_no' => 'required|max:10|unique:tbl_supplier_master',
            // Add other validation rules for the remaining fields if needed
        ]);

        
    if ($validator->fails()) {
        $errors = $validator->errors();
        $customErrors = [];

        if ($errors->has('s_mobile_no')) {
            $customErrors['s_mobile_no'] = 'The Mobile no has already been taken.';
        }

        // Add custom error messages for other fields if needed

        return response()->json(['errors' => $customErrors], 422);
    }
        $supplier = new Supplier_Model;
        $supplier->s_name = $request->input('s_name');
        $supplier->s_mobile_no = $request->input('s_mobile_no');
        $supplier->s_email = $request->input('s_email');
        $supplier->s_pincode = $request->input('s_pincode');
        $supplier->s_state = $request->input('s_state');
        $supplier->s_city = $request->input('s_city');
        $supplier->s_taluka = $request->input('s_taluka');
        $supplier->s_village = $request->input('s_village');
        $supplier->s_address = $request->input('s_address');
        $supplier->s_note = $request->input('s_note');
        $supplier->save();

        if ($supplier) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }


     //Fetch data from database
     public function fetchSuppliersData()
     {
         $supplier = Supplier_Model::all();
 
         return response()->json([
             'data' => $supplier,
         ]);
     }


        // Delete Expense data 
    public function deleteSupplierData($s_id)
    {
        $supplier = Supplier_Model::findOrFail($s_id);
    
        $supplier->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $supplier->save();
    
        return response()->json([
            'message' => 'Record deleted',
        ]);
    }
}
