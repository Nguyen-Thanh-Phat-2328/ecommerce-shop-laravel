<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchAdvancedController extends Controller
{
    public function indexSearchAdvance() {
        $products = Product::orderby('created_at', 'desc')->paginate(3);
        $categories = Category::all();
        $brands = Brand::all();
        return view('frontend/search-advanced/search-advanced', compact('products', 'categories', 'brands'));
    }

    public function search(Request $request) {
        $query = Product::query();

        if($request->name) {
            $query->where('name', 'LIKE', '%'. $request->name .'%');
        }

        if($request->price) {
            $price = explode('-', $request->price);
            $query->whereBetween('price', $price);
        }

        if($request->category) {
            $query->where('id_category', $request->category);
        }

        if($request->brand) {
            $query->where('id_brand', $request->brand);
        }

        if($request->status !== null) {
            $query->where('status', $request->status);
        }

        $products = $query->paginate(3);

        $categories = Category::all();
        $brands = Brand::all();

        return view('frontend/search-advanced/search-advanced', compact('products', 'categories', 'brands'));
    }
}
