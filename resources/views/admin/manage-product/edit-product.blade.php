@extends('admin/layouts/app')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">List Products</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12">Name<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Name" name="name" value="{{ $product->name }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Price<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input type="number" placeholder="Price" name="price" value="{{ $product->price }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Category<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <select name="id_category" id="">
                                    <option value="">Chọn category</option>
                                    @foreach ($categories as $item => $value)
                                        <option value="{{ $value->id }}" {{ $product->id_category == $value->id ? 'selected' : '' }}>{{ $value->category }}</option>                           
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Brand<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <select name="id_brand" id="">
                                    <option value="">Chọn brand</option>
                                    @foreach ($brands as $item => $value)
                                        <option value="{{ $value->id }}" {{ $product->id_brand == $value->id ? 'selected' : '' }}>{{ $value->brand }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Address<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <select name="status" id="status">
                                    <option value="1">sale</option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>new</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="sale">
                            <label class="col-md-12">Sale<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input type="number" placeholder="nhập % giảm" name="sale" value="{{ $product->sale }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Avatar<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input type="file" name="image[]" multiple/>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- <label class="col-md-12">Avatar<span style="color: red">(*)</span></label> --}}
                            <div class="col-md-12">
                                {{-- anh hiện tại trong DB --}}
                                <div style="display: flex;">
                                    @foreach (json_decode($product->image, true) as $key => $value)
                                        <div style="align-items: center; display: flex; margin-right: 10px; flex-direction: column;">
                                            <img style="width: 50px; height: 60px;" src="{{ asset('upload/product/'.$value) }}" alt="">
                                            <input style="width: 20px; height: 20px;" type="checkbox" name="delete_image[]" value="{{ $value }}">
                                        </div>                
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Detail<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <textarea name="detail" id="" cols="30" rows="10" placeholder="Mô tả sản phẩm">{{ $product->detail }}</textarea>
                            </div>
                        </div>
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
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" name="submit" type="submit">Edit product</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            if($('#status').val() == '1') {
                $('#sale').show();
            } else {
                $('#sale').hide();
            }

            $('#status').change(function() {
                if($(this).val() == '1') {
                    $('#sale').show();
                } else {
                    $('#sale').hide();
                }
            })
        });
    </script>
@endsection