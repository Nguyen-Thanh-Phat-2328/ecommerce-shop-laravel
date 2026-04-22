@extends('frontend.layouts.app')
@section('content')
    <section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="#" method="post" enctype="multipart/form-data">
                            @csrf
							<input type="text" placeholder="Email Address" name="email"/>
							<input type="password" placeholder="Password" name="password"/>
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
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
							<button type="submit" class="btn btn-default">Login</button>
						</form>
                        <br>
                        <a href="{{ url('/frontend/register') }}">Đăng ký tài khoản |</a>
                        <a href="{{ url('/frontend/forget-password') }}">Quên mật khẩu</a>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection