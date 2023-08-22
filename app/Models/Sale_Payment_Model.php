<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_Payment_Model extends Model
{
    use HasFactory;

    protected $table = 'tbl_sale_payment';
    protected $primaryKey = "id";

    protected $fillable = [
        'payment_type',
        'order_no',
        'unique_id',
        'contact_no',
        'date',
        'paid_amount',
        'available_bal',
        'payment_mode'
    ];
}
