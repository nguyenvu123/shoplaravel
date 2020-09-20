<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryPoducts extends Controller
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
    public function add_category_product()
    {
        $this->Authlogin();
        return view('admin.addCategory');
    }

    public function all_category_product()
    {
        $this->Authlogin();
        $all_category_products =  DB::table('tbl_category_product')->get();

        return view('admin.allCategory',['all_category_products'=>$all_category_products]);
    }



    public function save_category_product(Request $request) {
        $this->Authlogin();
        $data = array();
        $data ['category_name'] = $request->category_product_name;
        $data ['category_des'] = $request->category_product_desc;
        $data ['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        Session::put('messge','Thêm danh mục thành công');
        return Redirect::to('add-category-product');

    }

    public function active_category($id) {
        $this->Authlogin();
        DB::table('tbl_category_product')
            ->where('category_id', $id)
            ->update(['category_status' => 1]);

        $all_category_products =  DB::table('tbl_category_product')->get();

        return view('admin.allCategory',['all_category_products'=>$all_category_products]);

    }

    public function unactive_category($id) {
        $this->Authlogin();
        DB::table('tbl_category_product')
            ->where('category_id', $id)
            ->update(['category_status' => 0]);

        $all_category_products =  DB::table('tbl_category_product')->get();

        return view('admin.allCategory',['all_category_products'=>$all_category_products]);

    }

    public function  delete_category($id) {
        $this->Authlogin();
        DB::table('tbl_category_product')
            ->where('category_id', $id)
            ->delete();
        $all_category_products =  DB::table('tbl_category_product')->get();

        return view('admin.allCategory',['all_category_products'=>$all_category_products]);
    }
}
