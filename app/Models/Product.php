<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['product_id','product_name','category_id','brand_id','product_des','product_content','product_price','product_img','product_status'];

    protected $primaryKey = 'product_id';
    protected $table = 'tbl__product';

}
