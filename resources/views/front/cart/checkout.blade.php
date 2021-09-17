<!DOCTYPE html>
<html lang="en">
<head>
    @yield('css')
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
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
                    <tr id="cart_"{{$cart->rowId}}>
                        <td class="cart_product">
                            <a href=""><img src="{{ $cart->options->feature_image_path  }}" width="110px" height="110px"
                                            alt=""></a>
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
                                           name="qtyCart" value="{{ $cart->qty }}" autocomplete="off" size="2">
                                    <input name="rowIdItem" type="hidden" class="form-control"
                                           value="{{  $cart->rowId }}">
                                    <button style="margin-left: 6px; margin-top: 2px;" type="submit"
                                            class="btn btn-warning btn-sm mt-2">Update
                                    </button>
                                </form>
                            </div>
                        </td>

                        <td class="cart_total">
                            <p class="cart_total_price total_cart"> {{  number_format($cart->price * $cart->qty )}} </p>
                        </td>

                        <td class="cart_delete">
                            <a href="{{route('front.removeCart',['id' => $cart->rowId])}}" type="submit"
                               class="btn btn-warning btn-sm mt-2 btn-delete">
                                Delete
                            </a>
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
        @if(session('status'))
        <div class="swal2-container swal2-center swal2-backdrop-show" style="overflow-y: auto;">
            <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container"
                 class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog"
                 aria-live="assertive" aria-modal="true" style="display: grid;">
                <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: none;">×
                </button>
                <ul class="swal2-progress-steps" style="display: none;"></ul>
                <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                    <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                    <div class="swal2-success-ring"></div>
                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                </div>
                <img class="swal2-image" style="display: none;">
                <h2 class="swal2-title" id="swal2-title" style="display: block;">Success!</h2>
                <div class="swal2-html-container" id="swal2-html-container" style="display: block;">
                    {{ session('status') }}
                </div>
                <input class="swal2-input" style="display: none;"><input type="file" class="swal2-file"
                                                                         style="display: none;">
                <div class="swal2-range" style="display: none;"><input type="range">
                    <output></output>
                </div>
                <select class="swal2-select" style="display: none;"></select>
                <div class="swal2-radio" style="display: none;"></div>
                <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span
                            class="swal2-label"></span></label><textarea class="swal2-textarea"
                                                                         style="display: none;"></textarea>
                <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                <div class="swal2-actions" style="display: flex;">
                    <div class="swal2-loader"></div>
                    <button type="button" class="swal2-confirm swal2-styled delete_session" aria-label=""
                            style="display: inline-block;">OK
                    </button>
                    <button type="button" class="swal2-deny swal2-styled" aria-label="" style="display: none;">No
                    </button>
                    <button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: none;">
                        Cancel
                    </button>
                </div>
                <div class="swal2-footer" style="display: none;"></div>
                <div class="swal2-timer-progress-bar-container">
                    <div class="swal2-timer-progress-bar" style="display: none;"></div>
                </div>
            </div>
        </div>
        @endif
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
{{--<script>--}}
    {{--$(function () {--}}
        {{--$('.delete_session').click(function () {--}}
            {{--$('.swal2-center').removeClass('swal2-container')--}}
        {{--})--}}
        {{--$('body').click(function () {--}}
            {{--$('.swal2-center').removeClass('swal2-container')--}}
        {{--})--}}
    {{--})--}}
{{--</script>--}}
@yield('js')

</body>
</html>