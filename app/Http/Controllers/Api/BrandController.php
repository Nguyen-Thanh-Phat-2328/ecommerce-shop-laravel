<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function getBrand() {
        $brands = Brand::all();
        return response()->json([
            'message' => 'get thành công',
            'data' => $brands
        ]);
    }

    public function createBrand(BrandRequest $request) {
            $brand = Brand::create([
                'brand' => $request['brand']
            ]);
    
            return response()->json([
                'message' => 'Tạo brand thành công',
                'data' => $brand
            ]);
    }
}
