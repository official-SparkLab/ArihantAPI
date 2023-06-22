<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_company_details';
    protected $primaryKey = 'c_id';
    protected $fillable = [
        'c_name',
        'c_mobile_no',
        'c_email',
        'c_city',
        'c_state',
        'c_address',
        'c_gst_no',
        'c_company_code',
        'c_acc_no',
        'c_ifsc',
        'c_bank_name',
        'c_branch',
    ];
}
