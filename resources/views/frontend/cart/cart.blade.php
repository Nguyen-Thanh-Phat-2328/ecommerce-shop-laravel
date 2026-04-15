@extends('frontend/layouts/app')
@section('content')
@php
    $totalPrice = 0;
@endphp
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Shopping Cart</li>
				</ol>
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
						</tr>
					</thead>
					<tbody id="table-cart">
                        @php
                            $cart = session()->get('cart', []);
                        @endphp

                        @if (count($cart) > 0)
                            @foreach ($cart as $key => $value)
                                    @php
                                        $totalPrice = $totalPrice + $value['price'] * $value['qty'];
                                    @endphp
                                    <tr class="item-product">
                                        <td class="cart_product">
                                            <a href=""><img style="with: 100px; height: 150px;" src="{{ asset('upload/product/'.json_decode($value['image'], true)[0]) }}" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href=""><?php echo $value['name'] ?></a></h4>
                                            <p>Web ID: 1089772</p>
                                        </td>
                                        <td class="cart_price">
                                            <p>$<?php echo $value['price'] ?></p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <a class="cart_quantity_up" id-product="<?php echo $key ?>"> + </a>
                                                <input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $value['qty'] ?>" autocomplete="off" size="2">
                                                <a class="cart_quantity_down" id-product="<?php echo $key ?>"> - </a>
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">$<?php echo $value['price'] * $value['qty'] ?></p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete" id-product="<?php echo $key ?>"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center; color: #FE980F;">Không có mặt hàng nào</td>
                            </tr>
                        @endif
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>

							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>

							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span class="cart_total">$<?php echo $totalPrice ?></span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span class="pay_total">$<?php echo $totalPrice + 2 ?></span></li>
						</ul>
						<a class="btn btn-default update" href="">Update</a>
						<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection

@section('script')
<script>
	$(document).ready(function() {
		$(document).on('click', '.cart_quantity_up', function() {
			let $this = $(this);
			$id_product = $(this).attr('id-product');
			// alert('up: ' + $id_product);
			$.ajax({
				type: 'POST',
				url: '{{ url("frontend/up-date-cart/ajax") }}',
				data: {
					id_product: $id_product,
					action: 'up'
				},
				success: function(data) {
					if(data.status == 'success') {
						const cartCountElement = document.querySelector('.cart-count');
						const itemCart = $this.closest('.item-product');
						const inputQuantity = itemCart.find('.cart_quantity_input');
						const totalItemcart = itemCart.find('.cart_total_price');
				
						//trên header
						let currentCount = parseInt(cartCountElement.textContent);
						cartCountElement.textContent = currentCount + 1;

						let qtyCurrent = parseInt(inputQuantity.val());
						inputQuantity.val(qtyCurrent + 1);
						
						//tổng tiền từng sp
						const price = parseFloat(totalItemcart.text().replace('$', ''))/qtyCurrent;
						totalItemcart.text('$' + price * (parseInt(inputQuantity.val())));

						totalPrice();
					} else {
						alert(data.message);
					}
				}
			});
		})

		$(document).on('click', '.cart_quantity_down', function() {
			let $this = $(this);
			$id_product = $(this).attr('id-product');
			// alert('down: ' + $id_product);
			$.ajax({
				type: 'POST',
				url: '{{ url("frontend/up-date-cart/ajax") }}',
				data: {
					id_product: $id_product,
					action: 'down'
				},
				success: function(data) {
					if(data.status == 'success') {
						const cartCountElement = document.querySelector('.cart-count');
						const itemCart = $this.closest('.item-product');
						const inputQuantity = itemCart.find('.cart_quantity_input');
						const totalItemcart = itemCart.find('.cart_total_price');
				
						//trên header
						let currentCount = parseInt(cartCountElement.textContent);
						cartCountElement.textContent = currentCount - 1;

						let qtyCurrent = parseInt(inputQuantity.val());
						inputQuantity.val(qtyCurrent - 1);
						
						//tổng tiền từng sp
						const price = parseFloat(totalItemcart.text().replace('$', ''))/qtyCurrent;
						totalItemcart.text('$' + price * (parseInt(inputQuantity.val())));

						totalPrice();
					} else {
						alert(data.message);
					}
				}
			});
		})

		function totalPrice() {
			const totalArea = document.querySelector('.total_area');
			const totalNoCost = totalArea.querySelector('.cart_total');
			const totalCoCost = totalArea.querySelector('.pay_total');

			const itemCart = document.querySelectorAll('.item-product');

			let total = 0;

			itemCart.forEach(element => {
				total = total + parseFloat(element.querySelector('.cart_total_price').textContent.replace('$', ''));
			});

			totalNoCost.textContent = '$' + total;
			totalCoCost.textContent = '$' + parseFloat(total + 2);
		}

		$(document).on('click', '.cart_quantity_delete', function() {
			$this = $(this);
			id_product = $(this).attr('id-product');
			// alert('xóa ' + id_product);
			$.ajax({
				type: 'POST',
				url: '{{ url("frontend/up-date-cart/ajax") }}',
				data: {
					id_product: id_product,
					action: 'delete'
				},
				success: function(data) {
					if(data.status == 'success') {
						const cartCountElement = document.querySelector('.cart-count');
						const itemCart = $this.closest('.item-product');
						const inputQuantity = itemCart.find('.cart_quantity_input');
				
						//trên header
						let currentCount = parseInt(cartCountElement.textContent);
						cartCountElement.textContent = currentCount - parseInt(inputQuantity.val());

						itemCart.remove();

						totalPrice();
					} else {
						alert(data.message);
					}
				}
			})
		})
	})
</script>
@endsection