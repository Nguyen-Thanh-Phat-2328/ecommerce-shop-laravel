<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory() {
        $categories = Category::all();
        return response()->json([
            'message' => 'get thành công',
            'data' => $categories
        ]);
    }

    public function createCategory(CategoryRequest $request) {
        $category = Category::create([
            'category' => $request['category']
        ]);

        return response()->json([
            'message' => 'Tạo category thành công',
            'data' => $category
        ]);
    }
}
