<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_add_customer';
    protected $primaryKey = 'c_id';

    
    protected $fillable = [
        'c_name',
        'c_mobile_no',
        'c_email',
        'c_pincode',
        'c_state',
        'c_city',
        'c_taluka',
        'c_post_office',
        'c_village',
        'c_address',
        'c_note'
    ];
}
