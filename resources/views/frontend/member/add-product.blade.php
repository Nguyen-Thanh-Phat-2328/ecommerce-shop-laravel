@extends('frontend/layouts/app')
@section('content')
    <div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Add product</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>New Product!</h2>
						<form method="post" enctype="multipart/form-data">
                            @csrf
							<input type="text" placeholder="Name" name="name"/>
                            <input type="number" placeholder="Price" name="price">
                            <select name="id_category" id="">
                                <option value="">Chọn category</option>
                                @foreach ($categories as $item => $value)
                                    <option value="{{ $value->id }}">{{ $value->category }}</option>                           
                                @endforeach
                            </select>
                            <select name="id_brand" id="">
                                <option value="">Chọn brand</option>
                                @foreach ($brands as $item => $value)
                                    <option value="{{ $value->id }}">{{ $value->brand }}</option>
                                @endforeach
                            </select>
                            <select name="status" id="status">
                                <option value="1">sale</option>
                                <option value="0" selected>new</option>
                            </select>
                            <input type="number" placeholder="nhập % giảm" name="sale" id="sale">
							<input type="text" placeholder="thông tin công ty" name="company"/>
							<input type="file" name="image[]" multiple/>
                            <textarea name="detail" id="" cols="30" rows="10" placeholder="Mô tả sản phẩm"></textarea>
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
							<button type="submit" class="btn btn-default">Add Product</button>
						</form>
					</div>
					</div>
				</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#sale').hide();
        $('#status').change(function() {
            if ($(this).val() == '1') {
                $('#sale').show();
            } else {
                $('#sale').hide();
            }
        });
    });
</script>
@endsection