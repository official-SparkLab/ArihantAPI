<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_supplier_master';
    protected $primaryKey = 's_id';
    protected $fillable = [
        's_name',
        's_mobile_no',
        's_email',
        's_pincode',
        's_state',
        's_city',
        's_taluka',
        's_village',
        's_address',
        's_note'
    ];
}