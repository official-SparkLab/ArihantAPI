<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details_model extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_details';

    protected $fillable  = [
        'order_no',
        'order_date',
        'order_type',
        'contact_no',
        'sub_total',
        'discount',
        'grand_total',
        'payment_mode',
        'order_status'
    ];
}
