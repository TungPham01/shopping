<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug,$id)
    {
        $categoriesLimit = Category::where('parent_id', 0)->get();
        $slider = Slider::latest()->take(3)->get();
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::where('category_id', $id)->paginate(12);
        return view('front.category.product.index', compact('categoriesLimit', 'slider', 'categories', 'products'));
    }
}
