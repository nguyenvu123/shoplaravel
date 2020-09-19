<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function add_product()
    {

        return view('admin.addProduct');
    }

    public function all_brand_product()
    {
        $all_brand_products =  DB::table('tbl_brand_product')->get();

        return view('admin.allBrand',['all_brand_products'=>$all_brand_products]);
    }



    public function save_brand_product(Request $request) {
        $data = array();
        $data ['brand_name'] = $request->brand_product_name;
        $data ['brand_des'] = $request->brand_product_desc;
        $data ['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand_product')->insert($data);
        Session::put('messge','Thêm thuognw hiệu thành công!!');
        return Redirect::to('add-brand-product');

    }

    public function active_brand($id) {
        DB::table('tbl_brand_product')
            ->where('brand_id', $id)
            ->update(['brand_status' => 1]);

        $all_brand_products =  DB::table('tbl_brand_product')->get();

        return view('admin.allBrand',['all_brand_products'=>$all_brand_products]);

    }

    public function unactive_brand($id) {
        DB::table('tbl_brand_product')
            ->where('brand_id', $id)
            ->update(['brand_status' => 0]);

        $all_brand_products =  DB::table('tbl_brand_product')->get();

        return view('admin.allBrand',['all_brand_products'=>$all_brand_products]);

    }

    public function  delete_brand($id) {
        DB::table('tbl_brand_product')
            ->where('brand_id', $id)
            ->delete();
        $all_brand_products =  DB::table('tbl_brand_product')->get();

        return view('admin.allBrand',['all_brand_products'=>$all_brand_products]);
    }
}
