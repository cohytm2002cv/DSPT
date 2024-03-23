<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Group;
use App\Models\News;
use  App\Models\User;

class UserController extends Controller
{
    public function index($id)
    {
        $groups=Group::all();
        $news = News::where('user_id', $id)->get();
        return view('news.home', ['news' => $news,
            'groups'=>$groups,
            ]);
    }
    public function toggleLock(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->is_locked = !$user->is_locked;
        $user->save();

        return redirect()->back()->with('success', 'Trạng thái khóa tài khoản đã được cập nhật.');
    }
}
