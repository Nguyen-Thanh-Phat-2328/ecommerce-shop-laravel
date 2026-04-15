<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCartAjax(Request $request) {
        $id_product = $request->id_product;
        $product = Product::find($id_product);

        if(!$product) {
            return response()->json([
                'status' => 'error'
            ]);
        }
        
        $cart = [];
        if(session()->has('cart')) {
            $cart = session()->get('cart');
        }

        $qty = 1;
        if($request->quanty) {
            $qty = $request->quanty;
        }

        if(isset($cart[$id_product])) {
            $cart[$id_product]['qty'] = $cart[$id_product]['qty'] + $qty;
        } else {
            $cart[$id_product] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'qty' => $qty
            ];
        }

        session()->put('cart', $cart);

        // var_dump(session()->get('cart'));

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function cartIndex() {
        return view('frontend/cart/cart');
    }

    public function cartUpdate(Request $request) {
        $id_product = $request->id_product;
        $action = $request->action;

        if(session()->has('cart')) {
            $cart = session()->get('cart', []);
        }

        if($action == 'up') {
            $cart[$id_product]['qty'] = $cart[$id_product]['qty'] + 1;
        }

        if($action == 'down') {
            if($cart[$id_product]['qty'] == 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'chỉ còn một sản phẩm'
                ]);
            } else {
                $cart[$id_product]['qty'] = $cart[$id_product]['qty'] - 1;
            }
        }

        if($action == 'delete') {
            unset($cart[$id_product]);
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success'
        ]);
        
    }
}
