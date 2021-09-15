<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(12);
        $slider = Slider::latest()->take(3)->get();
        $categories = Category::where('parent_id', 0)->get();
        return view('front.product.index',compact('products','slider','categories'));
    }
}
