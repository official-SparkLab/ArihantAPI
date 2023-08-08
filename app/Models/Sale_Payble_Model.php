<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Payble_Model extends Model
{
    protected $table = 'sale_payable';
    protected $primaryKey = "sp_id";

    protected $fillable = [
        'date',
        'contact_no',
        'cust_name',
        'pending_amount',
        'paid_amount',
        'available_bal',
        'payment_mode',
        'trx_no',
        'description'
    ];

    public function orderDetails()
    {
        return $this->hasMany(Order_details_model::class, 'contact_no', 'contact_no');
    }
}
