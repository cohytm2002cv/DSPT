<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Models\News;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('news.home');
});

Route::get('/home',[NewsController::class,'index'])->name('home');
Route::get('/show/{id}',[GroupController::class,'show'])->name('group');
Route::get('/news/{id}',[NewsController::class,'show'])->name('show');

Route::get('/login',[AuthController::class,'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard/news/{id}',[UserController::class,'index']);
Route::get('/news/group/{id}',[GroupController::class,'find']);

Route::post('/comments', [CommentController::class,'store'])->name('comments.store');

Route::get('/log/',
    function (){
    return view('dashboard.user.logout');
    }
);

Route::middleware(['auth.dashboard'])->group(function () {
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/',[DashboardController::class,'index']);
    Route::get('/post',[DashboardController::class,'post']);
    Route::post('/post',[NewsController::class,'store'])->name('post.store');
    Route::resource('news', NewsController::class);
    Route::get('/tables',[DashboardController::class,'tables'])->name('tables');
    Route::get('/dashboard/banner',[BannerController::class,'banner'])->name('banner');
    Route::post('/banners', [BannerController::class,'storeOrUpdate'])->name('banners.createOrUpdate');
    Route::get('/dashboard/group',[GroupController::class,'index'])->name('group');
    Route::post('/dashboard/group/post',[GroupController::class,'store'])->name('group.store');

    Route::delete('/groups/{id}', [GroupController::class, 'destroy']);

    Route::get('/groups/{id}/', [GroupController::class, 'edit'])->name('groups.edit');

// Route để xử lý dữ liệu được gửi từ form sửa đổi
    Route::put('/groups/{id}', [GroupController::class, 'update'])->name('groups.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    //loc kq

});
Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admin/user/', [DashboardController::class, 'user'])->name('admin.user');
    Route::get('/dashboard/Admin/Group/', [DashboardController::class, 'group'])->name('admin.group');

    Route::get('/dashboard/fillter/', [DashboardController::class, 'filter'])->name('news.filter');
    Route::get('/dashboard/search/', [DashboardController::class, 'search'])->name('search');
    Route::post('/toggle-lock/{userId}', [UserController::class,'toggleLock'])->name('toggleLock');
});


