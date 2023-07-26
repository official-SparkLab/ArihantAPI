<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //
    public function createUser (Request $request) {


        $validator = Validator::make($request->all(), [
            'user_contact' => 'required|max:10|unique:tbl_users',
            'user_email' => 'required|unique:tbl_users',

            // Add other validation rules for the remaining fields if needed
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            $userErrors = [];
    
            if ($errors->has('user_contact')) {
                $userErrors['user_contact'] = 'The Mobile no has already been taken.';
            }

            if ($errors->has('user_email')) {
                $userErrors['user_email'] = 'The email  has already been taken.';
            }
    
            // Add custom error messages for other fields if needed
    
            return response()->json(['errors' => $userErrors], 422);
        }

        $user = new User;
        $user->user_name = $request->input("user_name");
        $user->user_gender = $request->input("user_gender");
        $user->user_contact = $request->input("user_contact");
        $user->user_email = $request->input("user_email");
        $user->user_password = bcrypt($request->input("user_password"));

        $user->save();

        if($user)
        {
            return response()->json(["Message" => "User saved successfully"]);
        }
        else {
            return response()->json(["Message" => "Failed to save user"]);
        }

    }
}
