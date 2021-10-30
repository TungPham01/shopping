@php
    use App\Helpers\Helper;
@endphp
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i
                                            class="fa fa-phone"></i> {{ Helper::getConfigValueFromSettingTable('contact') }}
                                </a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{ Helper::getConfigValueFromSettingTable('email') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ Helper::getConfigValueFromSettingTable('facebook_link') }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="{{ Helper::getConfigValueFromSettingTable('facebook_link') }}"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-4 clearfix">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="/eshopper/images/home/logo.png" alt=""/></a>
                    </div>
                </div>
                <div class="col-md-8 clearfix">
                    <div class="shop-menu clearfix pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href=""><i class="fa fa-user"></i> Account</a></li>
                            <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href=""><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li>
                                <a href="{{ route('front.showCart') }}"><i class="fa fa-shopping-cart"></i> Cart
                                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                                        {{ \Cart::count() }}
                                    </span>
                                </a>
                            </li>
                            <li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>
                            <li>
                                <div class="btn-group pull-right clearfix">
                                    {{--<button type="button" class="btn btn-default dropdown-toggle usa" style="margin-right: 0" data-toggle="dropdown">--}}
                                    <button type="button" class="btn btn-default get dropdown-toggle " style="margin: 0" data-toggle="dropdown">
                                        {{ __('front.language') }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach (\App\Helpers\Helper::LANGUAGE as $key => $language)
                                            <li style="width: 100%; padding: 0" class="">
                                                <a class="hover_language" style="padding: 5px 15px" href="{{ route('language', ['language' => $key]) }}">
                                                    <img width="31px" class="logo-language mr-3" src="{{ asset('storage/logo/'.strtolower($key).'.png')}}" />
                                                    <span class="">{{ $language }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    @include('front.partials.menu2')
</header><!--/header-->