@extends('frontend/layouts/app')
@section('content')
    Đổi mk cho {{ $email }}
    <form action="" method="post">
        @csrf
        <input type="email" name="email" value="{{ $email }}" hidden>
        <input type="password" name="password" placeholder="Nhập mật khẩu mới">
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
        <button type="submit">Đổi mật khẩu</button>
    </form>
@endsection