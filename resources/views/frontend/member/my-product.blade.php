@extends('frontend/layouts/app')
@section('content')
    <div class="col-sm-9">
					<div class="table-responsive cart_info">
						<table class="table table-condensed">
							<thead>
								<tr class="cart_menu">
									<td class="image">image</td>
									<td class="description">name</td>
									<td class="price">price</td>
									
									<td class="total">action</td>
									
								</tr>
							</thead>
							<tbody>
								@foreach ($products as $item => $value)
									<tr>
										<td class="cart_product">
											<a href=""><img style="width: 100px; height: 120px;" src="{{ asset('upload/product/'.json_decode($value->image, true)[0]) }}" alt=""></a>
										</td>
										<td class="cart_description">
											<h4><a href="">{{ $value->name }}</a></h4>
											
										</td>
										<td class="cart_price">
											<p>${{ $value->price }}</p>
										</td>
										
										<td class="cart_total">
											<a href="{{ url('frontend/account/edit-product/'.$value->id) }}">edit</a>
											<a href="{{ url('frontend/account/delete-product/'.$value->id) }}">delete</a>
										</td>
										
									</tr>
								@endforeach	
								@if (count($products) == 0)
									<tr>	
										<td colspan="4" style="text-align: center; color: #FE980F;">Không có mặt hàng nào</td>		
									</tr>
								@endif					
							</tbody>
						</table>
                        <a href="{{ url('frontend/account/add-product') }}" class="btn btn-primary">Add Product</a>
					</div>
				</div>
@endsection