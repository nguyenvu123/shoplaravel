<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

class HomeController extends Controller
{
    public function index()
    {

        $categorys = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brands = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $products_new = DB::table('tbl__product')->where('product_status', '1')->orderby('product_id', 'desc')->limit(8)->get();

        return view('pages.home', [
            'categorys' => $categorys,
            'brands' => $brands,
            'products_new' =>$products_new
        ]);
    }
    public function search( Request $request){
        $categorys = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brands = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $keySearch = $request->keySearch;
        $searchProducts = DB::table('tbl__product')->where('product_name', 'like', '%'.$keySearch.'%')->orderby('brand_id', 'desc')->get();


        return view('pages.search', [
            'categorys' => $categorys,
            'brands' => $brands,
            'products_new' =>$searchProducts,
            'key' =>$keySearch,
        ]);
    }
}
