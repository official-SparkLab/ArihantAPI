<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode_Model extends Model
{
    use HasFactory;

    protected $table = "tbl_order_barcode";

    protected $primaryKey = "barcode_id";

    protected $fillable = [
        'order_no',
        'barcode'
    ];
}