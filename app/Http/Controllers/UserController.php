<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function createUser (Request $request) {

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
