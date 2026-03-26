<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    

    public function index()
    {
        // $blogs = Blog::all();
        $blogs = Blog::where('id_user', Auth::id())->get();
        return view('admin/blog/list', compact('blogs'));
    }

    public function add() {
        return view('admin/blog/add');
    }
    
    public function insert(InsertBlogRequest $request) {
        $userId = Auth::id();
        $data = $request->all();
        $file = $request->image;
        if(!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        }
        $data['id_user'] = $userId;
        if(Blog::create($data)) {
            if(!empty($file)) {
                $file->move('upload/blog/image', $file->getClientOriginalName());
            }
            return redirect() -> back() -> with('success', __('Tạo mới blog thành công'));
        } else {
            return redirect() -> back() -> withErrors('Tạo blog thất bại');
        }
    }

    public function edit($id) {
        $blog = Blog::where('id', $id)->get();
        return view('admin/blog/edit', compact('blog'));
    }

    public function update(UpdateBlogRequest $request, $id) {
        $blog = Blog::find($id);
        $data = $request->all();
        $file = $request->image;

        if(!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        } else {
            $data['image'] = $blog->image;
        }

        if($blog->update($data)) {
            if(!empty($file)) {
                $file->move('upload/blog/image', $file->getClientOriginalName());
            }
            return redirect() -> back() -> with('success', __('Update blog thành công'));
        } else {
            return redirect() -> back() -> withErrors('Update thất bại');
        }
    }

    public function delete($id) {
        $blog = Blog::find($id);
        if($blog->delete()) {
            return redirect('/admin/blog');
        } else {
            return redirect() -> back() -> withErrors('Xóa blog thất bại');
        }
    }
}