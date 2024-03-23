<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\News;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data=$request->validate([
            'name' => 'required|string|max:255',
            'cmt' => 'required|string',
            'news_id' => 'required|exists:news,id', // Kiểm tra tồn tại của id tin tức
        ]);
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->id_news = $request->news_id; // Gán id của tin tức đang xem
        $comment->cmt = $request->cmt;
        $comment->user_id=$request->user_id;
        $comment->save();
        return back()->with('success', 'Comment submitted successfully');
    }
    public function destroy(Comment $comment)
    {
        // Xóa comment
        $comment->delete();

        // Cập nhật các liên kết trong các bảng khác

        return back()->with('success', 'Comment deleted successfully');

        // Chuyển hướng hoặc trả về phản hồi tuỳ thuộc vào yêu cầu của bạn
    }
}
