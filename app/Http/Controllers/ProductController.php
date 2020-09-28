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

    public function Authlogin() {

        $admin_id = Session::get('admin_id');
        echo $admin_id;
        if($admin_id) {
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('admin')->send();
        }

    }


    public function add_product()
    {
        $this->Authlogin();
        $cates = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brands = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        return view('admin.addProduct',
            [
                'cates' =>$cates,
                'brands' =>$brands
            ]
        );
    }

    public function all_product()
    {
        $this->Authlogin();
        $all_products =  DB::table('tbl__product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl__product.category_id')
            ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl__product.brand_id')->orderby('tbl__product.product_id','desc')->get();

        return view('admin.allProduct',['all_products'=>$all_products]);
    }



    public function save_product(Request $request) {
        $this->Authlogin();
        $data = array();
        $data ['product_name'] = $request->product_name;
        $data ['product_price'] = $request->product_price;
        $data ['product_des'] = $request->product_des;
        $data ['product_content'] = $request->product_content;
        $data ['category_id'] = $request->category_product;
        $data ['brand_id'] = $request->brand_product;
        $data ['product_status'] = $request->product_status;
        $get_img = $request->file('product_img');
        $get_name_img =$get_img->getClientOriginalName();
        $new_name = current(explode('.',$get_name_img));
        echo $new_name;
        if($get_img){
            $new_img = $new_name.time().'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/upload/products', $new_img);
            $data['product_img'] = $new_img;

            DB::table('tbl__product')->insert($data);
            Session::put('messge','Thêm san pham thành công!!');
            return Redirect::to('add-product');
        }
        $data['product_img'] = '';

        DB::table('tbl__product')->insert($data);
        Session::put('messge','Thêm san pham thành công!!');
        return Redirect::to('add-product');

    }

    public function active_product($id) {
        $this->Authlogin();
        DB::table('tbl__product')
            ->where('product_id', $id)
            ->update(['product_status' => 1]);

        $all_products =  DB::table('tbl__product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl__product.category_id')
            ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl__product.brand_id')->orderby('tbl__product.product_id','desc')->get();

        return view('admin.allProduct',['all_products'=>$all_products]);

    }

    public function unactive_product($id) {
        $this->Authlogin();
        DB::table('tbl__product')
            ->where('product_id', $id)
            ->update(['product_status' => 0]);

        $all_products =  DB::table('tbl__product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl__product.category_id')
            ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl__product.brand_id')->orderby('tbl__product.product_id','desc')->get();

        return view('admin.allProduct',['all_products'=>$all_products]);

    }

    public function  delete_product($id) {
        $this->Authlogin();
        DB::table('tbl__product')
            ->where('product_id', $id)
            ->delete();
        $all_products =  DB::table('tbl__product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl__product.category_id')
            ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl__product.brand_id')->orderby('tbl__product.product_id','desc')->get();

        return view('admin.allProduct',['all_products'=>$all_products]);
    }

    public function detailProduct ($id) {
        $detailProduct = DB::table('tbl__product')->where('product_id', $id)->get();


        $categorys = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brands = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();





        return view('pages.productDetail',['detailProduct'=>$detailProduct,
            'categorys' => $categorys,
            'brands' => $brands,
            'detailProduct' =>$detailProduct,

        ]);
    }
}
