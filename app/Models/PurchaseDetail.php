<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'tbl_purchase_details';

    protected $fillable = [
        'invoice_no',
        'date',
        'contact_no',
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
