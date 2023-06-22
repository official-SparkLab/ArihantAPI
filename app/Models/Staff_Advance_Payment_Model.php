<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_Advance_Payment_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_staff_adv_payment';
    protected $primaryKey = 'p_id';
    protected $fillable = [
        'p_name',
       'p_adv_amt',
       'p_mode',
       'p_date',
       'p_description'
    ];
}
