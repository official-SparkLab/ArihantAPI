<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordered_Product_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_ordered_product';

    protected $fillable = [
        'p_id',
        'order_no',
        'product_name',
        'quantity',
        'rate',
        'total'
    ];
}
