<?php

namespace App\Http\Controllers;

use App\Models\Post_Data_Model;
use Illuminate\Http\Request;

class Post_Data_Controller extends Controller
{
    //
    public function addPostData(Request $request)
    {
        $postData = new Post_Data_Model;

       $postData->Assignment = $request->input('Assignment');
       $postData->Document_Type = $request->input('Document_Type');
       $postData->Document_Date = $request->input('Document_Date');
       $postData->Amount_Local_Currency = $request->input('Amount_Local_Currency');
       $postData->Profit_Center = $request->input('Profit_Center');
       $postData->Document_Number = $request->input('Document_Number');

        $postData->save();

        if($postData)
        {
            return response()->json(['message'=>'Payment added successfully']);
        }
        else{
            return response()->json(['message'=>'Failed to add payment']);
        }
    }
}
