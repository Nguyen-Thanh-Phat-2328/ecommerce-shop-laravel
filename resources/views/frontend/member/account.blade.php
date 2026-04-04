@extends('frontend/layouts/app')
@section('content')
    <div class="col-sm-9">
		<div class="blog-post-area">
			<h2 class="title text-center">Update user</h2>
				<div class="signup-form"><!--sign up form-->
					<h2>Update profile!</h2>
					<form action="" method="post" enctype="multipart/form-data">
                        @csrf
						<input type="text" placeholder="Name" name="name" value="{{ $user->name }}"/>
						<input disabled type="email" placeholder="Email Address" name="email" value="{{ $user->email }}"/>
						<input type="password" placeholder="Password" name="password"/>
                        <input type="text" name="phone" placeholder="Phone" value="{{ $user->phone }}">
                        <input type="text" name="address" placeholder="Address" value="{{ $user->address }}">
                        <select name="id_country" id="">
                            @foreach ($countries as $key => $value)
                                <option value="{{ $value->id }}" {{ $value->id == $user->id_country ? 'selected' : '' }}>
                                    {{ $value->name }}
                                </option>
                            @endforeach
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
						<button type="submit" class="btn btn-default">Update</button>
					</form>
		        </div>
	    </div>
    </div>
@endsection