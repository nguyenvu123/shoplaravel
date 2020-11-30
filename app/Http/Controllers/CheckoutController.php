<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
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
        return Redirect('/payment');
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

    public function payment() {

        $categorys = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brands = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.payment',[

            'categorys' => $categorys,
            'brands' => $brands

        ]);

    }

    public function orderPlace(Request $request) {

        $content = Cart::content();
        $data = array();
        $data['payment_method'] =  $request->payment_option;
        $data['payment_status'] =  'Đang chờ sử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);


        //install order
        $orderData = array();
        $orderData['custom_id'] =  Session::get('customer_id');
        $orderData['shipping_id'] =  Session::get('shipping_id');
        $orderData['payment_id'] =  $payment_id;
        $orderData['order_status'] = 'Đang chờ sử lý';
        $orderData['order_total'] = Cart::total();
        $order_id = DB::table('tbl_order')->insertGetId($orderData);

     //orderdetail

        $orderD = array();
        foreach ( $content as $value) {
            $orderD['order_id'] =  $order_id;
            $orderD['product_id'] =  $value->id;
            $orderD['product_name'] =  $value->name;
            $orderD['product_price'] =  $value->price;
            $orderD['product_sales_quantity'] =  $value->qty;
             DB::table('tbl_order_details')->insert($orderD);
        }
        if($data['payment_method'] ==1) {
            echo "1";
        }else {
            $categorys = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
            $brands = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
            Cart::destroy();
            return view('pages.checkout.handcash',[

                'categorys' => $categorys,
                'brands' => $brands

            ]);
        }

    }

    public function manage_order() {
        $this->Authlogin();
        $all_order =  DB::table('tbl_order')
            ->join('tbl_customer','tbl_customer.customer_id', '=', 'tbl_order.custom_id')
           ->select('tbl_order.*','tbl_customer.customer_name')
            ->orderby('tbl_order.order_id','desc')->get();


        return view('admin.manage_order',[
            'all_orders' =>$all_order
        ]);
    }

    public function detailOrder($id) {
        $this->Authlogin();
        $all_order_detail =  DB::table('tbl_order_details')
            ->where('tbl_order_details.order_id', $id)
            ->orderby('order_id', 'desc')->get();


        return view('admin.detail_order',[
            'all_order_detail' =>$all_order_detail
        ]);
    }

    public function addToCartAjax(Request $request) {
       $data = $request->all();
       $id = ($data['id']);
       $productDetail = Product::find($id);
       $data = array();
        $data['id'] = $productDetail->product_id;
        $data['qty'] = 1;
        $data['name'] = $productDetail->product_name;
        $data['price'] = $productDetail->product_price;
        $data['option']['image'] = $productDetail->product_img;
        $data['weight'] = '123';
        Cart::add($data);
        echo Cart::count();
    }

    public function showBrandAjax(Request $request) {
        $data = $request->all();
        $id = ($data['id']);
    }
}
