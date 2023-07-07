<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    protected $table = 'tbl_purchased_product';

    protected $fillable = [
        'invoice_no',
        'p_id',
        'product_name',
        'unit',
        'quantity',
        'rate',
        'total',
    ];
}
