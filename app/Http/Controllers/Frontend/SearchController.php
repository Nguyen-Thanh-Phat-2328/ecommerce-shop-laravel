<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function indexSearch(Request $request) {
        // $key = $_GET['key'];
        $key = $request->key;
        if($key == '') {
            $products = Product::all();
        } else {
            $products = Product::where('name', 'LIKE', "%{$key}%")->get();
        }
        
        return view('frontend/search/search', compact('products'));
    }
}
