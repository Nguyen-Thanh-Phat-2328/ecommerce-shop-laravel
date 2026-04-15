@extends('frontend.layouts.app')
@section('content')
    <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
						foreach ($products as $key => $value) {
						?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ asset('upload/product/'.json_decode($value->image, true)[0]) }}" alt="" />
											<h2>$<?php echo $value['price']; ?></h2>
											<p><?php echo $value['name']; ?></p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>$<?php echo $value['price']; ?></h2>
												<p><?php echo $value['title']; ?></p>
												<a id="btn-add-to-cart" id-product="<?php echo $value['id']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
									</div>
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
											<li><a href="{{ url('frontend/product/detail/'.$value['id']) }}"><i class="fa fa-plus-square"></i>Product detail</a></li>
										</ul>
									</div>
								</div>
							</div>
						<?php
						}
						?>

					</div><!--features_items-->
@endsection
@section('script')
	<script>
		$(document).ready(function() {
			$(document).on('click', '#btn-add-to-cart', function(){
				var $checkLogin = "{{ Auth::Check() }}";

				if($checkLogin) {
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
				} else {
					alert('vui long Login');
				}
			})
		})
	</script>
@endsection