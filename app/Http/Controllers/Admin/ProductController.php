<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin/manage-product/index', compact('products'));
    }

    public function viewEdit($id) {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin/manage-product/edit-product', compact('product', 'categories', 'brands'));
    }

    public function update(UpdateProductRequest $request, $id) {
        $product = Product::findOrFail($id);
        $data = $request->all();

        $old_image = json_decode($product->image, true);
        $delete_image = $request->delete_image;

        $dataImage = $old_image;

        if($delete_image) {
            foreach($delete_image as $valueDelete) {
                foreach($old_image as $keyOld => $valueOld) {
                    if ($valueDelete == $valueOld) {
                        unset($dataImage[$keyOld]);
                    }
                }
            }
            $dataImage = array_values($dataImage);
        }

        if($request->hasFile('image')) {
            foreach($request->file('image') as $xx) {
                $image = Image::read($xx);

                $name = $xx->getClientOriginalName();
                $name_2 = "hinh50_".$xx->getClientOriginalName();
                $name_3 = "hinh200_".$xx->getClientOriginalName();

                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name_2);
                $path3 = public_path('upload/product/' . $name_3);

                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);

                $dataImage[] = $name;
            }
        }

        if(count($dataImage) > 3) {
            return redirect() -> back() -> withErrors('Số lượng ảnh không được vượt quá 3');
        }

        $data['image'] = json_encode($dataImage);

        if($product->update($data)) {
            return redirect() -> back() -> with('success', __('Cập nhật sản phẩm thành công'));
        } else {
            return redirect() -> back() -> withErrors('Cập nhật sản phẩm thất bại');
        }
    }

    public function delete($id) {
        $product = Product::FindOrFail($id);
        if($product->delete()) {
            return redirect() -> back() -> with('success', __('Xóa sản phẩm thành công'));
        } else {
            return redirect() -> back() -> withErrors('Xóa sản phẩm thất bại');
        }
    }

    public function search(Request $request) {
        $key = $request->key;
        if($key == '') {
            $products = Product::all();
        } else {
            $products = Product::join('users', 'products.id_user', '=', 'users.id')
            ->where('users.name', 'like', '%' . $key . '%')
            ->select('products.*')
            ->get();
        }
        
        return view('admin/manage-product/index', compact('products'));
    }

    public function orderIndex() {
        $orders = History::all();
        return view('admin/history-order/index', compact('orders'));
    }
}