<?php

namespace App\Http\Controllers;

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
}
