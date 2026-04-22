@extends('admin/layouts/app')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">List users</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                <input type="text" placeholder="Name" name="name" value="{{ $user[0]->name }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Email<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input disabled type="email" placeholder="Email Address" name="email" value="{{ $user[0]->email }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input type="password" placeholder="Password" name="password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input type="text" name="phone" placeholder="Phone" value="{{ $user[0]->phone }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Address<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input type="text" name="address" placeholder="Address" value="{{ $user[0]->address }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Country<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <select name="id_country" id="">
                                    @foreach ($countries as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $user[0]->id_country ? 'selected' : '' }}>
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Avatar<span style="color: red">(*)</span></label>
                            <div class="col-md-12">
                                <input type="file" name="avatar">
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
                                            <button class="btn btn-success" name="submit" type="submit">Edit user</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
@endsection