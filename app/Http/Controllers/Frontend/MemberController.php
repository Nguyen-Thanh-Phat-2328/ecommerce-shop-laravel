<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function add(){
        $countries = Country::all();
        return view('frontend.member.register', compact('countries'));
    }

    public function register(RegisterRequest $request) {
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
}
