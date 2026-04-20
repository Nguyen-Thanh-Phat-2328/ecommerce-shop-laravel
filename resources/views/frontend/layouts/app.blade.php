<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/rate.css') }}">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
	@include('frontend.layouts.header')
	
    @if (!request()->is('frontend/register') && !request()->is('frontend/login') && !request()->is('frontend/blog') && !request()->is('frontend/blog/detail/*') && !request()->is('frontend/account/*') && !request()->is('frontend/cart') && !request()->is('frontend/checkout') && !request()->is('frontend/shop/*')) 
        @include('frontend.layouts.slide')
    @endif

	<section>
		<div class="container">
			<div class="row">
				
                @if (!request()->is('frontend/register') && !request()->is('frontend/login') && !request()->is('frontend/account/*') && !request()->is('frontend/cart') && !request()->is('frontend/checkout'))
                    @include('frontend.layouts.menu-left')
                @elseif(request()->is('frontend/account/*'))
                    @include('frontend.layouts.menu-left-account')
                @endif

                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>

			</div>
		</div>
	</section>
	
	@include('frontend.layouts.footer')
  
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    {{-- <script src="{{ asset('frontend/js/jquery-1.9.1.min.js') }}"></script> --}}

    @yield('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $(document).on('click', '#btn-add-to-cart', function(){
				var $id_product = $(this).attr('id-product');
				// alert($id_product);
				$.ajax({
					type: 'POST',
					url: '{{ url("frontend/add-to-cart/ajax") }}',
					data: {
						id_product: $id_product
					},
					success: function(data) {
						if(data.status == 'success') {
							alert('Them thanh cong');

							//update tổng cart header
							const cartCountElement = document.querySelector('.cart-count');
							// alert(cartCountElement.textContent);
							let currentCount = parseInt(cartCountElement.textContent);
							cartCountElement.textContent = currentCount + 1;
						} else {
							alert('Them that bai');
						}
					},
				})
			})

            $(document).ready(function() {
				$('#sl2').on('slideStop', function(e) {
					var price = e.value;
					alert(price[0] + " " + price[1]);
                    $.ajax({
                        type: 'POST',
                        url: '{{ url("frontend/shop/search-price") }}',
                        data: {
                            min_price: price[0],
                            max_price: price[1]
                        },
                        success: function(data) {
                            $('.col-sm-9.padding-right').html('');
                            data.products.forEach(function(product) {
                                var productHtml = `
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('upload/product/')}}/${JSON.parse(product.image)[0]}" alt="" />
                                                    <h2>$${product.price}</h2>
                                                    <p>${product.name}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>$${product.price}</h2>
                                                        <a id="btn-add-to-cart" id-product="${product.id}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                        <li><a href="{{ url('frontend/product/detail/${product.id}') }}"><i class="fa fa-plus-square"></i>Product detail</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                $('.col-sm-9.padding-right').append(productHtml);
                            });

                            if($('.col-sm-9.padding-right').html() == '') {
                                $('.col-sm-9.padding-right').html('<p style="color: #fdb45e">không có sản phẩm phù hợp</p>');
                            }
                        },
                    })
				})
			})
        })
    </script>
</body>
</html>