@extends('frontend/layouts/app')
@section('content')
    <div class="features_items"><!--features_items-->
		<h2 class="title text-center">Features Items</h2>
		<form action="{{ url('/frontend/shop/search-advanced') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="filter-bar">

				<input type="text" name="name" placeholder="Name">

				<select name="price">
					<option value="">Choose price</option>
					<option value="0-500">0 - 500$</option>
					<option value="500-1000">500 - 1000$</option>
					<option value="1000-1500">1000 - 1500$</option>
				</select>

				<select name="category">
					<option value="">Category</option>
					@foreach ($categories as $cate)
						<option value="{{ $cate->id }}">{{ $cate->category }}</option>
					@endforeach
				</select>

				<select name="brand">
					<option value="">Brand</option>
					@foreach ($brands as $brand)
						<option value="{{ $brand->id }}">{{ $brand->brand }}</option>
					@endforeach
				</select>

				<select name="status">
					<option value="">Status</option>
					<option value="0">New</option>
					<option value="1">Sale</option>
				</select>

				<button type="submit">Search</button>

			</div>
		</form>
        @if (count($products) == 0)
            <p style="color: #fdb45e">không có sản phẩm phù hợp</p>
        @else
            @foreach ($products as $value)
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
            @endforeach
        @endif
		<div class="row">
			<div class="col-sm-12 text-center">
				{{ $products->links('pagination::bootstrap-5') }}
			</div>
		</div>
	</div><!--features_items-->
@endsection