<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_enquiry_details';
    protected $primaryKey = 'e_id';
    protected $fillable = [
        'e_name',
        'e_mobile_no',
        'e_date',
        'e_village',
        'product_name',
        'e_note',
        'e_reason'
    ];
}