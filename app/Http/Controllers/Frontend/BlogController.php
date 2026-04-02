<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderby('created_at', 'desc')->paginate(3);
        return view('frontend/blog/index', compact('blogs'));
    }

    public function blogDetail($id)
    {
        $blogCurrent = Blog::find($id);

        $blogPrev = Blog::where('created_at', '<', $blogCurrent->created_at)->orderBy('created_at', 'desc')->first();

        $blogNext = Blog::where('created_at', '>', $blogCurrent->created_at)->orderBy('created_at', 'asc')->first();

        $rate = Rate::where('id_blog', $id)->avg('rate');
        $rateRound = round($rate);
        $rateCount = Rate::where('id_blog', $id)->count('rate');
        
        return view('frontend/blog/blog-detail', compact('blogCurrent', 'blogPrev', 'blogNext', 'rateRound', 'rateCount'));
    }

    public function blogRateAjax(Request $request) {
        $rate = $request->input('rate');
        $blogId = $request->input('id_blog');
        $userId = Auth::id();
        $checkRate = Rate::where('id_user', $userId)->where('id_blog', $blogId)->first();
        if($checkRate) {
            //cho rate nhiều lần
            // $checkRate->rate = $rate;
            // $checkRate->save();

            //rate 1 lần
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn đã đánh giá rồi'
            ]);
        } else {
            Rate::create([
                'id_user' => $userId,
                'id_blog' => $blogId,
                'rate' => $rate,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Đánh giá thành công'
            ]);
        }
    }
}
