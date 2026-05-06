<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlog()
    {
        $blogs = Blog::all();
        return response()->json([
            'data' => $blogs
        ]);
    }

    public function getBlogById($id) {
        $blog = Blog::find($id);
        if(!$blog) {
            return response()->json([
                'message' => 'Không tồn tại blog trên'
            ]);
        } else {
            return response()->json([
                'message' => 'get thành công',
                'data' => $blog
            ]);
        }
    }
}
