<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Đảm bảo sử dụng Illuminate\Support\Facades\Auth
use Illuminate\Support\Facades\Cookie;
use App\Repositories\UserRepository;
use App\Services\UserService;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('dashboard.login');
    }


    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $userRepository = new UserRepository();
        $user = $userRepository->findEmail($email);//responsitory parrten

//        $user = DB::table('users')->where('email', $email)->first();
        if ($user && $password ==$user->password) {
            // Đăng nhập thành công
            Auth::loginUsingId($user->id);
            $cookieData = [
                'user_id' => $user->id,
                'user_name' => $user->name,
            ];
            $cookie = Cookie::make('user_data', json_encode($cookieData), 60);

            return redirect()->intended('/dashboard')->withCookie($cookie);
        } else {
            // Đăng nhập thất bại
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        // Đăng xuất người dùng
        Auth::logout();

        // Xóa hết cookie liên quan đến người dùng
        Cookie::queue(Cookie::forget('user_data'));

        // Chuyển hướng đến trang đăng nhập hoặc trang chính
        return redirect()->route('login');
    }

}
