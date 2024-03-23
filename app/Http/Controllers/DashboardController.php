<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class DashboardController extends Controller
{

    public function tables(Request $request)
    {
        $user = Auth::user();
        $id=$user->id;
        $user = User::find($id);
        $news = $user->news;
        return view('dashboard.user.tables',[
            'news'=>$news,
        ]);
    }
    public function post()
    {
        $user = Auth::user();
        $id=$user->id;
        $user = User::find($id);
        $news = $user->news;
        $groups=Group::all();
        return view('dashboard.user.post',[
            'news'=>$news,
            'groups'=>$groups,
        ]);
    }
    public  function index()
    {
        $groups=Group::all();
        $new=News::all();
        $users=User::all();

        return view('dashboard.admin.index',[
            'news'=>$new,
            'users'=>$users,
            'groups'=>$groups,

        ]);
    }
    public  function user()
    {

        $users=User::all();

        return view('dashboard.admin.user',[
            'users'=>$users,
        ]);
    }
    public function filter(Request $request)
    {
        $author = $request->input('author');
        $groups = $request->input('groups');

        $news = News::query();
        if ($author) {
            $news->where('user_id', $author)->where('group_id',$groups)->get();
        }

        $filteredNews = $news->get();


        // Trả về view và chuyển dữ liệu tin tức đã lọc vào view
        return view('dashboard.admin.index', [
            'news' => $filteredNews,
            'users' => User::all(),
            'groups'=>Group::all()// Truyền tất cả người dùng, nếu cần
        ]);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $news=News::all();
        $users = User::where('name', 'LIKE', "%$query%")->get();
        return view('dashboard.admin.index', [
            'users' => $users,
            'news'=>$news,
            'groups'=>Group::all()// Truyền tất cả người dùng, nếu cần
        ]);    }

}
