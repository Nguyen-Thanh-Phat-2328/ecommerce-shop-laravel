<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function profileView() {
        $countries = Country::all();
        $user = Auth::user();
        return view('frontend/member/account', compact('countries', 'user'));
    }

    public function profileUpdate(UpdateProfileRequest $request) {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->all();
        $file = $request->avatar;

        if(!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        if($user->update($data)) {
            if(!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect() -> back() -> with('success', __('Update profile thanh cong'));
        } else {
            return redirect() -> back() -> withErrors('Update thất bại');
        }
    }

    public function myProduct() {
        return view('frontend/member/my-product');
    }

    public function addProduct() {
        $brands = Brand::all();
        $categories = Category::all();
        return view('frontend/member/add-product', compact('brands', 'categories'));
    }

    public function insertProduct(AddProductRequest $request) {
        $data = $request->all();
        $data['id_user'] = Auth::id();
        if(Product::create($data)) {
            return redirect() -> back() -> with('success', __('Thêm sản phẩm thành công'));
        } else {
            return redirect() -> back() -> withErrors('Thêm sản phẩm thất bại');
        }
    }
}
