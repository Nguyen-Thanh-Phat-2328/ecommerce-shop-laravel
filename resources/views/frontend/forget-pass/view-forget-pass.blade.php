@extends('frontend/layouts/app')
@section('content')
    <input type="email" placeholder="Email Address" name="email"/>
    <p>Click <a id="btn-send-mail-forget-pass">vào đây</a> để nhận mail đổi mật khẩu</p>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#btn-send-mail-forget-pass').click(function() {
                email = $('[name = "email"]').val();
                if(email == '') {
                    alert('Vui lòng nhập email');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url("/frontend/forget-password/sendmail/ajax") }}',
                        data: {
                            email: email,
                            url: 'http://127.0.0.1:8000/frontend/forget-password/reset?email=' + email
                        },
                        success: function(data) {
                            alert(data);
                        }
                    })
                }               
            })
        })
    </script>
@endsection