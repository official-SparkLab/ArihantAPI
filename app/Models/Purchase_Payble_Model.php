<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Payble_Model extends Model
{
    use HasFactory;

    protected $table = 'purchase_payable';
    protected $primaryKey = "p_id";

    protected $fillable = [
        'date',
        'contact_no',
        'sup_name',
        'pending_amount',
        'paid_amount',
        'available_bal',
        'payment_mode',
        'trx_no',
        'description'
    ];
}
