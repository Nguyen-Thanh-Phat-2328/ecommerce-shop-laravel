<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.manage-member.index', compact('users'));
    }

    public function viewEdit(Request $request, $id)
    {
        $user = User::where('id', $id)->get();
        $countries = Country::all();
        return view('admin.manage-member.edit-member', compact('user', 'countries'));
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);
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
            return redirect() -> back() -> with('success', __('Update user thanh cong'));
        } else {
            return redirect() -> back() -> withErrors('Update thất bại');
        }
    }

    public function delete($id) {
        $user = User::FindOrFail($id);
        if($user->delete()) {
            return redirect() -> back() -> with('success', __('Xóa user thành công'));
        } else {
            return redirect() -> back() -> withErrors('Xóa user thất bại');
        }
    }
}
