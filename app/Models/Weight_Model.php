<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight_Model extends Model
{
    use HasFactory;

    protected $table = 'tbl_order_weight';

    protected $primaryKey = 'wt_id';

    protected $fillable = [
        'order_no',
        'weight',
    ];
}
