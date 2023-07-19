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


    // Define the relationship between Barcode_Model and Weight_Model
    public function weight()
    {
        return $this->hasOne(Weight_Model::class, 'order_no', 'order_no');
    }
}