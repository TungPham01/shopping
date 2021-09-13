@extends('front.layouts.master')

@section('title')
    Home
@endsection

@section('css')
    <link href="{{ asset('front/home/home.css') }}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{ asset('front/home/home.js') }}"></script>
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('front.partials.sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset($product->feature_image_path) }}" alt=""/>
                                            <h2>{{ number_format($product->price )}} VNĐ</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{ number_format($product->price )}}</h2>
                                                <p>{{ $product->name }}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!--features_items-->

                    <!--category-tab-->
                    <div class="category-tab">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                @foreach($categories as $key => $category)
                                    <li class="{{  $key == 0  ? 'active' : '' }}">
                                        <a href="#category_tab_{{ $category->id }}"
                                           data-toggle="tab">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content">
                            @foreach($categories as $key => $category)
                                <div class="tab-pane fade {{ $key == 0  ? 'active in' : ''   }}"
                                     id="category_tab_{{ $category->id }}">
                                    @if($category->products->count())
                                        @foreach($category->products as $item)
                                            <div class="col-sm-3">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="/eshopper/images/home/gallery1.jpg" alt=""/>
                                                            <h2>{{ $item->price }}</h2>
                                                            <p>{{ $item->name }}</p>
                                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @else
                                       <span style="padding-left:15px;">Danh mục chưa có sản phẩm</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div><!--/category-tab-->

                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                {{--
                                    - chạy vòng lặp kiểm tra nếu sản phẩm chia 3 bằng 0 active đầu tiên
                                    - nếu không chia thì cứ chạy ra từng div
                                    - nếu đủ 6 lần = 5/3 của mảng thì đóng
                                --}}
                                @foreach($productsRecomment as $key => $item)
                                    @if($key%3 == 0)
                                        <div class="item {{ $key == 0 ? 'active' : ''}}">
                                            @endif
                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{ asset($item->feature_image_path) }}" alt=""/>
                                                            <h2>{{ number_format($item->price) }}</h2>
                                                            <p>{{ $item->name }}</p>
                                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            @if($key%3 == 2)
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel"
                               data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel"
                               data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>
@endsection

