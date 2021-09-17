<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
//    chỉ dùng trong cùng class
//    public function __construct()
//    {
//        $categoriesLimit = Category::where('parent_id',0)->get();
//        $slider = Slider::latest()->take(3)->get();
//        view()->share('categoriesLimit',$categoriesLimit);
//        view()->share('slider',$slider);
//    }

    public function index() {
        // LẤY 3 CÁI slide mới nhất để hiển thị
        $slider = Slider::latest()->take(3)->get();

        // lấy category cha
        $categories = Category::where('parent_id',0)->get();

        $categoriesAll = Category::all();
        // lấy 6 sản phẩm mới nhất
        $products = Product::latest()->take(6)->get();

        // lấy sản phẩm theo lượt xem giảm dần
        $productsRecomment  = Product::latest('views_count','desc')->take(6)->get();

        $categoriesLimit = Category::where('parent_id',0)->get();
        return view('front.home.home',compact('slider','categories','products','productsRecomment','categoriesLimit','categoriesAll'));
    }
}
