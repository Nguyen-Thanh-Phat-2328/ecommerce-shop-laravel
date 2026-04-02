<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegisterRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function registerView(){
        $countries = Country::all();
        return view('frontend/member/register', compact('countries'));
    }

    public function register(MemberRegisterRequest $request) {
        $data = $request->all();
        $data['level'] = 0;
        $file = $request->avatar;
        if(!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        $data['password'] = bcrypt($data['password']);

        if(User::create($data)){
            if(!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }

            return redirect() -> back() -> with('success', __('Tạo tài khoản thành công'));
        } else {
            return redirect() -> back() -> withErrors('Tạo thất bại');
        }
    }

    public function loginView(){
        return view('frontend/member/login');
    }

    public function login(MemberLoginRequest $request){
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];

        $remember = false;

        if($request->remember_me) {
            $remember = true;
        }

        if(Auth::attempt($login, $remember)) {
            return redirect('frontend/home');
        } else {
            return redirect() -> back() -> withErrors('Email hoặc mật khẩu không đúng.');
        }
    }
}
