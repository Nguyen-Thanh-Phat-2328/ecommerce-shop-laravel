@extends('frontend/layouts/app')
@section('content')
    <div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product" id="show-image-product">
								<img src="{{ asset('upload/product/'.json_decode($product->image, true)[0]) }}" alt="" />
								<a href="{{ asset('upload/product/'.json_decode($product->image, true)[0]) }}" rel="prettyPhoto"><h3>ZOOM</h3></a>				
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
                                            @foreach (json_decode($product->image, true) as $item)
                                                <a name-image="{{ $item }}" class="btn-item-image"><img src="{{ asset('upload/product/hinh50_'. $item) }}" alt=""></a>
                                            @endforeach
										</div>
										<div class="item">
                                            @foreach (json_decode($product->image, true) as $item)
                                                <a name-image="{{ $item }}" class="btn-item-image"><img src="{{ asset('upload/product/hinh50_'. $item) }}" alt=""></a>
                                            @endforeach
										</div>
										<div class="item">
                                            @foreach (json_decode($product->image, true) as $item)
                                                <a name-image="{{ $item }}" class="btn-item-image"><img src="{{ asset('upload/product/hinh50_'. $item) }}" alt=""></a>
                                            @endforeach
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $product->name }}</h2>
								<p>Web ID: 1089772</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>${{ $product->price }}</span>
									<label>Quantity:</label>
									<input type="number" value="1" id="quanty"/>
									<button type="button" class="btn btn-fefault cart add-to-cart" id-product="{{ $product->id }}">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> E-SHOPPER</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-item-image').click(function() {
                // alert('ok');
                
                var nameImage = $(this).attr('name-image');
                $('#show-image-product img').attr('src', `{{ asset('upload/product/${nameImage}') }}`);
				$('#show-image-product a').attr('href', `{{ asset('upload/product/${nameImage}') }}`);
            });
        });

		$(document).on('click', '.add-to-cart', function(){
			id_product = $(this).attr('id-product');
			inputQuanty = parseInt($('#quanty').val());
			if(inputQuanty <= 0) {
				alert('Nhập lớn hơn 0');
			} else {
				// alert('chạy ajax');
				$.ajax({
					type: 'POST',
					url: '{{ url("frontend/add-to-cart/ajax") }}',
					data: {
						id_product: id_product,
						quanty: inputQuanty
					},
					success: function(data) {
						if(data.status == 'success') {
							alert('Đã thêm vào giỏ hàng');
							
							//update trên header
							const cartCountElement = $('.cart-count');
							cartCountElement.text(parseInt(cartCountElement.text()) + inputQuanty);
						} else {
							alert(data.message);
						}
					}
				})
			}
		})
    </script>
@endsection