<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['brand_id','brand_name','brand_des','brand_status'];

    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand_product';

}
