<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
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
}
