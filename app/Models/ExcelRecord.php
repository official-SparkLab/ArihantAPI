<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelRecord extends Model
{
    use HasFactory;

    protected $table = "tbl_post_import_data";

    protected $fillable = [
        'assignment',
        'doc_type',
        'doc_date',
        'amount',
        "profit_center",
        "doc_no"
    ];

    public $timestamps = false;
}
