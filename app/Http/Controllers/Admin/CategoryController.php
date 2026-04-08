<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin/category/category', compact('categories'));
    }

    public function add()
    {
        return view('admin/category/add-category');
    }

    public function insert(CategoryRequest $request) {
        $newCategory = new Category();
        $newCategory->category = $request->category;
        $newCategory->save();
        return redirect('/admin/category');
    }

    public function edit($id) {
        $category = Category::where('id', $id)->get();
        return view('admin/category/edit-category', compact('category'));
    }

    public function update(CategoryRequest $request, $id) {
        if(Category::where('id', $id)->update(['category' => $request->category])) {
            return redirect() -> back() -> with('success', __('Update category thành công'));
        } else {
            return redirect() -> back() -> withErrors('Update thất bại');
        }
    }

    public function delete($id) {
        if(Category::where('id', $id)->delete()) {
            return redirect('admin/category');
        } else {
            return redirect() -> back() -> withErrors('Xóa thất bại');
        }
    }
}
