<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $slider = Slider::latest()->take(3)->get();
        $categories = Category::where('parent_id',0)->get();
        return view('front.home.home',compact('slider','categories'));
    }
}
