<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class FrontProductController extends Controller
{
    public function index(Request $request){
        $name = $request->searchProductName ?? '';
        if($name != ''){
            $products = Product::where('name','like',"%".$name. "%")->paginate(9);
        }else{
            $products = Product::paginate(9);
        }
        $slider = Slider::latest()->take(3)->get();
        $categories = Category::where('parent_id', 0)->get();
        return view('front.product.index',compact('products','slider','categories','name'));
    }
}
