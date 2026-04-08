<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin/brand/brand', compact('brands'));
    }

    public function add()
    {
        return view('admin/brand/add-brand');
    }

    public function insert(BrandRequest $request) {
        $newBrand = new Brand();
        $newBrand->brand = $request->brand;
        $newBrand->save();
        return redirect('/admin/brand');
    }

    public function edit($id) {
        $brand = Brand::where('id', $id)->get();
        return view('admin/brand/edit-brand', compact('brand'));
    }

    public function update(BrandRequest $request, $id) {
        if(Brand::where('id', $id)->update(['brand' => $request->brand])) {
            return redirect() -> back() -> with('success', __('Update brand thành công'));
        } else {
            return redirect() -> back() -> withErrors('Update thất bại');
        }
    }

    public function delete($id) {
        if(Brand::where('id', $id)->delete()) {
            return redirect('admin/brand');
        } else {
            return redirect() -> back() -> withErrors('Xóa thất bại');
        }
    }
}
