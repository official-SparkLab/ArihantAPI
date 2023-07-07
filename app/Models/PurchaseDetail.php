<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'tbl_purchase_details';

    protected $fillable = [
        'invoice_no',
        'date',
        'supplier_name',
        'place_of_supply',
        'dispatch_no',
        'destination',
        'shipping_cost',
        'sub_total',
        'discount',
        'grand_total'
    ];
}
