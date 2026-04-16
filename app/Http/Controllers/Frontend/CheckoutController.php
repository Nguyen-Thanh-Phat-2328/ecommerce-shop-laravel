<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Mail\OrderMail;
use App\Models\Country;
use App\Models\History;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\MemberRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mime\Email;

class CheckoutController extends Controller
{
    public function checkout() {
        $countries = Country::all();
        return view('frontend/checkout/checkout', compact('countries'));
    }

    public function sendMailOrder(Request $request) {
        $email = $request->email;
        $name = $request->name;
        $phone = $request->phone;
        $id_user = $request->id_user;
        $price = $request->price;
        $history = [
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'id_user' => $id_user,
            'price' => $price
        ];

        if(!History::create($history)) {
            return response()->json([
                'Đã xảy ra lỗi'
            ]);
        }

        $cart = session()->get('cart', []);

        $data = [
            'subject' => 'Thông tin đơn hàng',
            'cart' => $cart
        ];
        try{
            Mail::to($email)->send(new OrderMail($data));
            return response()->json(['Check mail của bạn']);
        } catch (Exception $th) {
            return response()->json(['sorry']);
        }
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

            //login sau khi đăng ký
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
                return redirect() -> back() -> with('success', __('Tạo tài khoản thành công, Order ngay'));
            }
        } else {
            return redirect() -> back() -> withErrors('Tạo thất bại');
        }
    }
}
