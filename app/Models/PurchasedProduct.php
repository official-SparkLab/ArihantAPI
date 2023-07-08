<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    use HasFactory;

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
