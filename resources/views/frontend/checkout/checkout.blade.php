@extends('frontend/layouts/app')
@section('content')
@php
	$cart = [];
@endphp
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

				<div class="register-flash" hidden>
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#" method="post" enctype="multipart/form-data">
                            @csrf
							<input type="text" placeholder="Name" name="name"/>
							<input type="email" placeholder="Email Address" name="email"/>
							<input type="password" placeholder="Password" name="password"/>
                            <input type="text" placeholder="phone" name="phone">
                            <input type="text" placeholder="address" name="address">
                            <select name="id_country" id="">
                                <option value="">Chọn quốc tịch</option>
                                <?php
                                                    foreach ($countries as $key => $value) {
                                                        ?>
                                                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                        <?php
                                                    }    
                                                ?>
                            </select>
                            <input type="file" name="avatar">
                            @if (session('success'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                            <h4><i class="icon fa fa-check"></i>Thông báo!</h4>
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if ($errors -> any())
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                            <ul>
                                                @foreach ($errors->all() as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			

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
						</tr>
					</thead>
					<tbody>
						@php
							$cart = session()->get('cart', []);
							$totalPrice = 0;
						@endphp
						@foreach ($cart as $key => $value)
							@php
								$totalPrice += (float)$value['price'] * (int)$value['qty']; 
							@endphp
							<tr>
								<td class="cart_product">
									<a href=""><img style="with: 100px; height: 150px;" src="{{ asset('upload/product/'.json_decode($value['image'], true)[0]) }}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{ $value['name'] }}</a></h4>
									<p>Web ID: 1089772</p>
								</td>
								<td class="cart_price">
									<p>${{ $value['price'] }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<input class="cart_quantity_input" type="text" name="quantity" value="{{ $value['qty'] }}" autocomplete="off" size="2">
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">${{ (float)$value['price'] * (int)$value['qty'] }}</p>
								</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td id="total-price">${{ $totalPrice }}</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>${{ $totalPrice + 2 }}</span></td>
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
					<span>
						<label><a class="btn btn-primary" id="btn-order">Order</a></label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
@endsection
@section('script')
	<script>
		$(document).ready(function() {
			$('#btn-order').click(function(){
				const elementRegisterFlash = $(document).find('.register-flash');
				const totalPrice = parseFloat($('#total-price').text().replace('$', ''));

				checkLogin = "{{ Auth::check() }}";
				if(checkLogin) {
					email = "{{ Auth::user()?->email }}";
					phone = "{{ Auth::user()?->phone }}";
					name = "{{ Auth::user()?->name }}";
					id_user = "{{ Auth::user()?->id }}";
					price = totalPrice;
					// alert(email + ' ' + phone + ' ' + name + ' ' + id_user + ' ' + price + ' ');
					$.ajax({
						type: 'POST',
						url: '{{ url("/frontend/sendmail/order/ajax") }}',
						data: {
							email: email,
							phone: phone,
							name: name,
							id_user: id_user,
							price: price
						},
						success: function(data) {
							alert(data);
						}
					})
				} else {
					alert('chua login');
					elementRegisterFlash.show();
				}
			})
		})
	</script>
@endsection