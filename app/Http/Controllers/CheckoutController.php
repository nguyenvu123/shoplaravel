<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function showCheckout(){
        return view('pages.checkout.showCheckout');
    }

    public function loginCheckout(){
        $categorys = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brands = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.loginCheckout',[

         'categorys' => $categorys,
         'brands' => $brands

        ]);
    }

    public function addCustomer(Request $request) {

        $data = array();
        $data['customer_name'] =  $request->name;
        $data['customer_email'] =  $request->email;
        $data['customer_password'] =  md5($request->password);
        $data['customer_phone'] =  $request->phone;
        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->name);
         return Redirect('/checkout');
    }

    public function checkout() {
        $categorys = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brands = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.showCheckout',[

            'categorys' => $categorys,
            'brands' => $brands

        ]);
       
    }

    public function saveShipping(Request $request) {
        $data = array();
        $data['shipping_name'] =  $request->shipping_name;
        $data['shipping_email'] =  $request->shipping_email;
        $data['shipping_notes'] =  $request->shipping_notes;
        $data['shipping_address'] =  $request->shipping_address;
        $data['shipping_phone'] =  $request->shipping_phone;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        Session::put('shipping_name',$request->name);
        return Redirect('/checkout');
    }
    public function login(Request $request) {
        $email = $request->email;
        $pass = md5($request->password);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$pass)->first();
//      var_dump($result->customer_id);
        if($result) {
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$result->customer_name);
            Session::put('customer_email',$result->customer_email);
            Session::put('customer_phone',$result->customer_phone);
            return Redirect('/checkout');
        }else {
            Session::put('mess','mật khẩu hoặc tài khoảng sai');
            return Redirect('/login-checkout');
        }

    }
    public function logout() {
        Session::flush();
        return Redirect('/login-checkout');
    }

}
