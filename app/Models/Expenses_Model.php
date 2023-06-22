<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses_Model extends Model
{
    use HasFactory;

    protected $table = 'tbl_expenses_details';
    protected $primaryKey = 'exp_id';
    protected $fillable = [
        'exp_name',
        'exp_details',
        'exp_date',
        'exp_amt',
        'exp_total_amt',
        'exp_paid_status',
        'exp_note',
    ];

    public $timestamps = false;
}
