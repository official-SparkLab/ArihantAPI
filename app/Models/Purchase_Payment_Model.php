<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Payment_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_purchase_payment';
    protected $primaryKey = "id";

    protected $fillable = [
        'invoice_no',
        'contact_no',
        'date',
        'paid_amount',
        'available_bal',
        'payment_mode'
    ];
}
