<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;


class BannerController extends Controller
{
    public function banner()
    {
        $banner=Banner::first();
        return view('dashboard.banner',[
            'banner'=>$banner,
        ]);
    }
    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = Banner::find(1);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners');
            $banner->image = $imagePath;
        }
        // Cập nhật thông tin title và link
        $banner->title = $validatedData['title'];

        // Lưu thay đổi vào cơ sở dữ liệu
        $banner->save();


        return redirect()->route('banner')->with('success', 'Banner saved successfully.');
    }
}
