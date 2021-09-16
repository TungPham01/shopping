<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use Gloudemans\Shoppingcart\Cart;
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

    public function addToCart($id){
        $products = Product::findOrFail($id);
        \Cart::add([
            'id' => $id,
            'name' => $products->name,
            'qty' => 1,
            'price' => $products->price,
            'weight' => 1,
            'options' => [
                'feature_image_path' => $products->feature_image_path,
                'content' => $products->content
            ]
        ]);
        return response()->json([
            'code' => 200,
            'message' => 'Thêm thành công'
        ],200);
    }

    public function showCart() {
        $carts = \Cart::content();
        return view('front.cart.checkout',compact('carts'));
    }

    public function removeCart() {

    }

    public  function editCart(Request $request) {
        $qty = $request->qtyCart;
        $rowId = $request->rowIdItem;
        $up = \Cart::update($rowId,$qty);
        return redirect()->route('front.showCart');
    }
}
