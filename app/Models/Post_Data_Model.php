<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_Data_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_post_data   ';
    protected $primaryKey = "sr_no";

    protected $fillable = [
       'barcode',
       'Document_Type',
       'Document_Date',
       'Amount_Local_Currency',
       'Profit_Center',
       'Document_Number',
       'import_Date'
    ];

    public $timestamps = false;
}
