<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_Details_Model extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_staff_details';
    protected $primaryKey = 's_id';
    protected $fillable = [
        's_name',
        's_dob',
        's_address',    
        's_mobile_no',
        's_joining_date',
        's_type',
        's_designation',
        's_salary',
        's_bank_name',
        's_ifsc',
        's_acc_no'
    ];
}
