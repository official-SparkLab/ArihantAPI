<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details_model extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_details';

    protected $primaryKey = "order_id";

    protected $fillable  = [
        'unique_id', 
        'order_date',
        'order_type',
        'contact_no',
        'sub_total',
        'discount',
        'grand_total',
        'payment_mode',
        'order_status',
        'cancel_reason'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer_Model::class, 'contact_no', 'c_mobile_no');
    }
}
