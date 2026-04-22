<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassMail;
use App\Mail\MailNotify;
use App\Mail\OrderMail;
use App\Mail\ResetPassMail;
use App\Models\History;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index() {
        $data = [
            'subject' => 'Khoa hoc full stack',
            'body' => 'Chao ban, day la email test'
        ];
        try{
            Mail::to('23042004phat@gmail.com')->send(new MailNotify($data));
            return response()->json(['Great check your mai box']);
        } catch (Exception $th) {
            return response()->json(['sorry']);
        }
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

    public function sendMailForgetPass(Request $request){
        $email = $request->email;
        $url = $request->url;

        $data = [
            'subject' => 'Quên mật khẩu',
            'email' => $email,
            'url' => $url  
        ];

        try{
            Mail::to($email)->send(new ForgetPassMail($data));
            return response()->json(['Check mail của bạn']);
        } catch (Exception $th) {
            return response()->json(['sorry']);
        }
    }
}
