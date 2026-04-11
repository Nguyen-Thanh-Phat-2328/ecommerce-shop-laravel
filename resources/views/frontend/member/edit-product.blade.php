@extends('frontend/layouts/app')
@section('content')
    <div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Update product</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>Update Product!</h2>
						<form method="post" enctype="multipart/form-data">
                            @csrf
							<input type="text" placeholder="Name" name="name" value="{{ $product->name }}"/>
                            <input type="number" placeholder="Price" name="price" value="{{ $product->price }}">
                            <select name="id_category" id="">
                                <option value="">Chọn category</option>
                                @foreach ($categories as $item => $value)
                                    <option value="{{ $value->id }}" {{ $product->id_category == $value->id ? 'selected' : '' }}>{{ $value->category }}</option>                           
                                @endforeach
                            </select>
                            <select name="id_brand" id="">
                                <option value="">Chọn brand</option>
                                @foreach ($brands as $item => $value)
                                    <option value="{{ $value->id }}" {{ $product->id_brand == $value->id ? 'selected' : '' }}>{{ $value->brand }}</option>
                                @endforeach
                            </select>
                            <select name="status" id="status">
                                <option value="1">sale</option>
                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>new</option>
                            </select>
                            <input type="number" placeholder="nhập % giảm" name="sale" id="sale" value="{{ $product->sale }}">
							{{-- <input type="text" placeholder="thông tin công ty" name="company" value="{{ $product->company }}"/> --}}
							<input type="file" name="image[]" multiple/>

                            {{-- anh hiện tại trong DB --}}
                            <div style="display: flex;">
                                @foreach (json_decode($product->image, true) as $key => $value)
                                    <div style="align-items: center; display: flex; margin-right: 10px; flex-direction: column;">
                                        <img style="width: 50px; height: 60px;" src="{{ asset('upload/product/'.$value) }}" alt="">
                                        <input style="width: 20px; height: 20px;" type="checkbox" name="delete_image[]" value="{{ $value }}">
                                    </div>                
                                @endforeach
                            </div>

                            <textarea name="detail" id="" cols="30" rows="10" placeholder="Mô tả sản phẩm">{{ $product->detail }}</textarea>
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
							<button type="submit" class="btn btn-default">Update Product</button>
						</form>
					</div>
					</div>
				</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        if ($('#status').val() == '1') {
            $('#sale').show();
        } else {
            $('#sale').hide();
        }

        $('#status').change(function() {
            if ($(this).val() == '1') {
                $('#sale').show();
            } else {
                $('#sale').hide();
            }
        });

        // let old_image_selected = [];
        // $('input[name="check_image[]"]').change(function() {
        //     if ($(this).is(':checked')) {
        //         old_image_selected.push($(this).val());
        //     } else {
        //         old_image_selected = old_image_selected.filter(item => item !== $(this).val());
        //     }
        //     // console.log(old_image_selected);
        // });
    });
</script>
@endsection