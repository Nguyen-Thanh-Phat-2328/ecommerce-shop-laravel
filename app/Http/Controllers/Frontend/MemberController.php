<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

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

    public function logout() {
        Auth::Logout();
        return redirect('frontend/login');
    }

    public function forgetPasswordView() {
        return view('frontend/forget-pass/view-forget-pass');
    }

    public function viewResetPass(Request $request) {
        $email = $request['email'];
        return view('frontend/forget-pass/reset-pass', compact('email'));
    }

     public function resetPass(Request $request) {
        $email = $request['email'];
        $newPassword = $request['password'];
        $user = User::where('email', $email)->first();
        if($user) {
            $user->password = bcrypt($newPassword);
            $user->save();
            return redirect('frontend/login')->with('success', 'Mật khẩu đã được đổi thành công.');
        } else {
            return redirect()->back()->withErrors('Không tìm thấy người dùng với email này.');
        }
    }
}
