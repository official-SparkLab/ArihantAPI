<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_Payment_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_staff_payment';
    protected $primaryKey = 'p_id';
    protected $fillable = [
        'p_name',
       'p_date',
       'p_salary_type',
       'p_salary_amt',
       'p_deduction',
       'p_description',
    ];
}
