<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Group;
use App\Models\News;
use Illuminate\Http\Request;
use App\DatabaseManager;
class GroupController extends Controller
{
    public function show($id)
    {
        $groups = Group::find($id);
        $dataManager = DatabaseManager::getInstance();
        $news = $dataManager->findNewsByGroupId($id);

        return view('groups.group', [
            'group' => $groups,
            'news'=>$news
        ]);
    }
    public function index()
    {
        $groups = Group::all();
        return view('dashboard.group', ['groups'=>$groups]);
    }
    public function find($id)
    {
        $banner=Banner::first();
        $groups=Group::all();
        $news = News::where('group_id', $id)->get();
        return view('news.home', ['news' => $news,
            'groups'=>$groups,
            'banner'=>$banner,]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other columns if needed
        ]);

         Group::create($validatedData);

        return redirect('/dashboard/group')->with('success', 'Group created successfully');
    }
//    public function destroy($id)
//    {
//        $group = Group::find($id);
//
//        if (!$group) {
//            return response()->json(['message' => 'Group not found'], 404);
//        }
//
//        $group->delete();
//
//        return response()->json(['message' => 'Group deleted successfully'], 200);
//    }
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->news()->delete();

        $group->delete();
        $gr=Group::all();
        return view('dashboard.group' ,['groups'=>$gr]);
    }

    public function edit($id)
    {
        $group = Group::find($id);

        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }

        return view('dashboard.groupedit', compact('group'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other fields if needed
        ]);

        $group = Group::find($id);

        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }

        $group->update($validatedData);

        return response()->json(['message' => 'Group updated successfully', 'data' => $group], 200);
    }
}
