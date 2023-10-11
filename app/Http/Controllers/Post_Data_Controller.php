<?php

namespace App\Http\Controllers;

use App\Models\Post_Data_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Post_Data_Controller extends Controller
{
    //
   public function getImportDate()
   {
    $data = DB::select("SELECT DISTINCT import_date from tbl_post_data;");
    return response()->json(["data" => $data]);
   }
}
