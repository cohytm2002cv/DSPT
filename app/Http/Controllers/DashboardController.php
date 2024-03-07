<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public  function index()
    {
        return view('dashboard.index');
    }
    public function tables(Request $request)
    {
        $user = Auth::user();
        $id=$user->id;
        $user = User::find($id);
        $news = $user->news;
        return view('dashboard.tables',[
            'news'=>$news,
        ]);
    }
    public function post()
    {
        $user = Auth::user();
        $id=$user->id;
        $user = User::find($id);
        $news = $user->news;
        return view('dashboard.post',[
            'news'=>$news,
        ]);
    }
}
