<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchPriceController extends Controller
{
    public function indexSearchPrice(Request $request)
    {
        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $products = Product::whereBetween('price', [$min_price, $max_price])->get();

        return response()->json([
            'products' => $products
        ]);
        
    }
}
