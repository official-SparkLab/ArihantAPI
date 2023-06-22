<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_product_master';
    protected $primaryKey = 'p_id';
    protected $fillable = [
        'p_name',
        'p_category',
        'p_batch',
        'p_rate',
        'p_note',
    ];

    
}
