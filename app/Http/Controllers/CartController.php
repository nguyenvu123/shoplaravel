<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;

session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $idProduct = $request->productid_hiden;
        $qty = $request->qty;
        $name = $request->productName;
        $price = $request->productPrice;
        $img = $request->productImage;
        $data['id'] = $idProduct;
        $data['qty'] = $qty;
        $data['name'] = $name;
        $data['price'] = $price;
        $data['option']['image'] = $img;
        $data['weight'] = '123';
        //Cart::destroy();
        Cart::add($data);

        return Redirect::to('/show-cart');
    }
    public function showCart()
    {
        $categorys = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brands = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();


        return view('pages.cart.showCart', [
            'categorys' => $categorys,
            'brands' => $brands,
        ]);
    }

    public function deleteProduct($id) {

        Cart::remove($id);
        return Redirect::to('/show-cart');

    }
}
