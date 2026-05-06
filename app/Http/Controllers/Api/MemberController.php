<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\LoginRequest;
use App\Http\Requests\api\RegisterRequest;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function login(LoginRequest $request) {
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
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'message' => 'login thanh cong',
                'token' => $token,
                'Auth' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Tai khoan hoac mat khau khong dung'
            ]);
        }
    }

    public function register(RegisterRequest $request) {
        $data = $request->all();
        $data['level'] = 0;
        $file = $request->avatar;
        if(!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        $data['password'] = bcrypt($data['password']);

        if($user = User::create($data)){
            if(!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }

            return response()->json([
                'message' => 'Tạo tài khoản thành công',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Tạo thất bại'
            ]);
        }
    }
}
