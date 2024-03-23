<?php

namespace App\Http\Controllers;
use App\DatabaseManager;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Group;
use App\Models\News;
use Illuminate\Http\Request;
use App\Repositories\NewsRepositoryInterface;
class NewsController extends Controller
{
    protected $newsRepository;
    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    public function index()
    {
        $news = News::all();
        $groups=Group::all();
        return view('news.home',
            [   'news' => $news,
                'groups'=>$groups,
             ]);
    }

    public function show($id)
    {
        $cmt= Comment::where('id_news', $id)->get(); // Truy vấn các bình luận với điều kiện id_news là id của bài viết

        $dataManager = DatabaseManager::getInstance();
        $new = $dataManager->findNewsById($id);
        $group=Group::all();
        return view('news.detail',
            ['new' => $new,
                'comments'=>$cmt,
                'groups'=>$group

        ]);
    }
    public function store(Request $request)
    {

        $userData = json_decode($request->cookie('user_data'), true);


        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Đảm bảo tệp là hình ảnh và không quá 2MB
            'group_id' => 'required|exists:groups,id', // Kiểm tra group_id có tồn tại trong bảng groups không

        ]);

        if ($request->hasFile('image')) {
            // Lưu trữ file ảnh vào thư mục public/images

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            // Lưu đường dẫn của ảnh vào dữ liệu
            $data['image_path'] = '/images/' . $imageName;

        }
        $data['user_id'] = $data['user_id'] ?? $userData['user_id'];
        $data['author'] = $data['author'] ?? $userData['user_name'];

        News::create($data);

        return redirect('tables')->with('success', 'News created successfully!');
    }
    public function destroy($id)
    {
        $news = $this->newsRepository->find($id);

        if (!$news) {
            return redirect('/tables')->with('error', 'News not found.');
        }

        $this->newsRepository->delete($id);

        return back()->with('success', 'Comment deleted successfully');
    }


}
