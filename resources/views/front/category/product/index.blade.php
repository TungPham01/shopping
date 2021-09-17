@extends('front.layouts.master')
@section('title') Product  @endsection

@section('content')
    <section>

        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
                <h2 class="title text-center">Products Items</h2>
                    @if(count($products))
                        @foreach($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ $product->feature_image_path }}" height="270px;" alt=""/>
                                            <h2>{{ number_format($product->price ) }} VNĐ</h2>
                                            <p>{{ $product->name }}</p>
                                            <a data-href="{{route('front.addToCart',['id'=>$product->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                                to cart</a>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p style="font-size: 20px">Sản phẩm tạm hết!</p>
                    @endif
            </div><!--features_items-->
            <div class="text-center">
                {{  $products->links() }}
            </div>

        </div>

    </section>

@endsection