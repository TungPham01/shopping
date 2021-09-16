<!DOCTYPE html>
<html lang="en">
<head>
    @yield('css')
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') | E-Shopper</title>
    <link href="{{asset('eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('eshopper/css/main.css')}}" rel="stylesheet">
</head>
<body>

@include('front.partials.header')

<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="{{ $cart->options->feature_image_path  }}" width="110px" height="110px" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $cart->name  }}</a></h4>
                                <p>{!!  $cart->options->content  !!}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($cart->price)}} VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form action="{{ route('front.editCart') }}" method="post" class="d-inline">
                                        @csrf
                                        <input class="cart_quantity_input " type="number"
                                               style="border-radius: 15px; padding: 5px 0 5px 7px; outline: none; "
                                               name="qtyCart" value="{{ $cart->qty }}"  autocomplete="off" size="2" >
                                        <input name="rowIdItem" type="hidden" class="form-control" value="{{  $cart->rowId }}">
                                        <button style="margin-left: 6px; margin-top: 2px;" type="submit" class="btn btn-warning btn-sm mt-2">Update</button>
                                    </form>
                                </div>
                            </td>

                            <td class="cart_total">
                                <p class="cart_total_price total_cart"> {{  number_format($cart->price * $cart->qty )}} </p>
                            </td>

                            <td class="cart_delete">
                                <button formaction="{{route('front.removeCart',['id' => $cart->id])}}" style="margin-left: 6px; margin-top: 2px;" type="submit" class="btn btn-warning btn-sm mt-2">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Total</td>
                                        <td><span>{{  \Cart::priceTotal() }}</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
            <span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
            <span>
						<label><input type="checkbox"> Paypal</label>
					</span>
        </div>
    </div>
</section> <!--/#cart_items-->

@include('front.partials.footer')


<script src="{{asset('eshopper/js/jquery.js')}}"></script>
<script src="{{asset('eshopper/js/bootstrap.min.js')}}"></script>
<script src="{{asset('eshopper/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('eshopper/js/price-range.js')}}"></script>
<script src="{{asset('eshopper/js/main.js')}}"></script>
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>

@yield('js')

</body>
</html>