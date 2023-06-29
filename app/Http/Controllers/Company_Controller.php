<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company_Model;
use Illuminate\Http\Request;

class Company_Controller extends Controller
{
    //
    //Add data to database
    public function addCompany(Request $request)
    {
        $company = new Company_Model;
        $company->c_name = $request->input('c_name');
        $company->c_mobile_no = $request->input('c_mobile_no');
        $company->c_email = $request->input('c_email');
        $company->c_city = $request->input('c_city');
        $company->c_state = $request->input('c_state');
        $company->c_address = $request->input('c_address');
        $company->c_gst_no = $request->input('c_gst_no');
        $company->c_company_code = $request->input('c_company_code');
        $company->c_acc_no = $request->input('c_acc_no');
        $company->c_ifsc = $request->input('c_ifsc');
        $company->c_bank_name = $request->input('c_bank_name');
        $company->c_branch = $request->input('c_branch');
        $company->save();

        if ($company) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }


     //Fetch data from database
     public function fetchCompanyData()
     {
         $company = Company_Model::all();
 
         return response()->json([
             'data' => $company,
         ]);
     }


 //Fetch Particular  data through id
 public function fetchDataById($c_id)
 {
     $Company = Company_Model::find($c_id);
  
     if (!$Company) {
         return response()->json([
             'message' => 'Product not found',
         ], 404);
     }
  
     return response()->json([
         'data' => $Company,
     ]);
 }

       //Add data to database
    public function updateCompany(Request $request,$c_id)
    {

        $company = Company_Model::find($c_id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        
        $company->c_name = $request->input('c_name');
        $company->c_mobile_no = $request->input('c_mobile_no');
        $company->c_email = $request->input('c_email');
        $company->c_city = $request->input('c_city');
        $company->c_state = $request->input('c_state');
        $company->c_address = $request->input('c_address');
        $company->c_gst_no = $request->input('c_gst_no');
        $company->c_company_code = $request->input('c_company_code');
        $company->c_acc_no = $request->input('c_acc_no');
        $company->c_ifsc = $request->input('c_ifsc');
        $company->c_bank_name = $request->input('c_bank_name');
        $company->c_branch = $request->input('c_branch');
        $company->save();

        if ($company) {
            return response()->json(['message' => 'Data Added Succesfully']);
        } else {
            return response()->json(['message' => 'Failed to store data']);
        }
    }


        // Delete Company data 
    public function deleteCompanyData($c_id)
    {
        $company = Company_Model::findOrFail($c_id);
        $company->status = 0; // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $company->save();
    
        return response()->json([
            'message' => 'Record deleted',
        ]);
    }
}
