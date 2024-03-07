<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    return view('auth.login');
});

Route::get('/home',[NewsController::class,'index']);
Route::get('/show/{id}',[GroupController::class,'show'])->name('group');
Route::get('/news/{id}',[NewsController::class,'show'])->name('show');

Route::get('/login',[AuthController::class,'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/log/',
    function (){
    return view('dashboard.logout');
    }
);

Route::middleware(['auth.dashboard'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/',[DashboardController::class,'index']);
    Route::get('/tables',[DashboardController::class,'tables']);
    Route::get('/post',[DashboardController::class,'post']);
    Route::post('/post',[NewsController::class,'store'])->name('post.store');
    Route::resource('news', NewsController::class);

});