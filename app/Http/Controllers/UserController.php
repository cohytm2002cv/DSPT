<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Group;
use App\Models\News;

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
}
