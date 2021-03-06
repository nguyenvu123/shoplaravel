<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function Authlogin() {

        $admin_id = Session::get('admin_id');
        echo $admin_id;
        if($admin_id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('admin')->send();
        }

    }

    public function add_brand_product()
    {
        $this->Authlogin();

        return view('admin.addBrand');
    }

    public function all_brand_product()
    {
        $all_brand_products = Brand::orderBy('brand_id', 'DESC')->get();
        return view('admin.allBrand',['all_brand_products'=>$all_brand_products]);
    }

    public function save_brand_product(Request $request) {
        $this->Authlogin();

        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_des = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        Session::put('messge','Thêm thuognw hiệu thành công!!');
        return Redirect::to('add-brand-product');

    }

    public function active_brand($id) {
        $this->Authlogin();
        $brand = Brand::find($id);
        $brand->brand_status = 1;
        $brand->save();
        $all_brand_products =  DB::table('tbl_brand_product')->get();
        return view('admin.allBrand',['all_brand_products'=>$all_brand_products]);
    }

    public function unactive_brand($id) {
        $this->Authlogin();
        $brand = Brand::find($id);
        $brand->brand_status = 0;
        $brand->save();
        $all_brand_products = Brand::orderBy('brand_id', 'DESC')->get();
        return view('admin.allBrand',['all_brand_products'=>$all_brand_products]);
    }

    public function  delete_brand($id) {
        $this->Authlogin();
         Brand::destroy($id);
        $all_brand_products =  Brand::orderBy('brand_id', 'DESC')->get();
        return view('admin.allBrand',['all_brand_products'=>$all_brand_products]);
    }
}
