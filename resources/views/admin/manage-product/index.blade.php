@extends('admin/layouts/app')
@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">List products</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
                            <form action="{{ url('/admin/product/search') }}" class="form-horizontal form-material" method="get" enctype="multipart/form-data" style="display: flex; align-items: center; margin-left: 20px;">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nhập tên member" name="key"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" name="submit" type="submit">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
<div class="container-fluid">
                <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-body">
                                <h4 class="card-title">Table Header</h4>
                                <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6>
                            </div> --}}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    <img src="{{ asset('upload/product/' . json_decode($value->image, true)[0]) }}" alt="{{ $value->name }}" width="50">
                                                </td>
                                                <td>{{ $value->name }}</td>
                                                <td>${{ number_format($value->price, 2) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/product/edit/'.$value->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="{{ url('admin/product/delete/'.$value->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <a href="{{ url('/admin/user/add') }}"><button class="btn btn-success">Add User</button></a> --}}
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
                    </div>
            </div>
@endsection