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

    public function addToCart($id) {
        $product = Product::find($id);

//        session()->flush();
        // gán session cart vào
        $cart = session()->get('cart');

        // nếu có $cart[$id] thì cộng thêm
        if(isset($cart[$id])){
            $cart[$id]['quantity'] =  $cart[$id]['quantity'] + 1;
        }else{
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'feature_image_path' => $product->feature_image_path,
                'content' => $product->content,
                'quantity' => 1
            ];
        }
        // put(): lưu trữ session
       session()->put('cart',$cart);
        return response()->json([
            'code' => 200,
            'message' => 'Thêm thành công'
        ],200);
    }

    public function showCart() {
        $carts = session()->get('cart');
        return view('front.cart.checkout',compact('carts'));
    }
}
