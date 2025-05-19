<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Video;
use App\Models\Reclam;
use Carbon\Carbon;
use App\Models\Interview;


class IndexController extends Controller
{
    public function old_index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $latest = Post::where(function ($query) use ($now) {
            $query->whereDate('date', '<=', $now)->orWhereNull('date');
        })->where('published', '1')->where('selected', '0')->orderby('date', 'desc')->take(10)->get();

        $top = Post::where(function ($query) use ($now) {
            $query->whereDate('date', '<=', $now)->orWhereNull('date');
        })->where('published', '1')->where('selected', '0')->orderby('date', 'desc')->where('top', '1')->take(3)->get();

        $banner = Banner::orderby('id', 'desc')->first();
        $category = Category::where('top', '0')->where('visible', '1')->orderby('orders', 'asc')->get();
        foreach ($category as $cat) {
            $catnews[] = Post::where(function ($query) use ($now) {
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->where('published', '1')->where('top', '0')->where('category_id', $cat->id)->orderby('id', 'desc')->take(3)->get();
        }
        $mostviewed = Post::where(function ($query) use ($now) {
            $query->whereDate('date', '<=', $now)->orWhereNull('date');
        })->where('published', '1')->orderby('votes', 'desc')->take(5)->get();
        $topcats = Category::where('top', '1')->first();
        $toppost = Post::where(function ($query) use ($now) {
            $query->whereDate('date', '<=', $now)->orWhereNull('date');
        })->where('published', '1')->where('selected', '0')->orderby('date', 'desc')->where('category_id', $topcats->id)->take(4)->get();
        $video = Video::orderby('id', 'desc')->take(6)->get();
        $reclamtop = Reclam::where('type', 'top')->where('page', 'index')->orderby('id', 'desc')->get();
        $reclambottom = Reclam::where('type', 'bottom')->where('page', 'index')->orderby('id', 'desc')->get();
        $cats = Category::orderby('ordering', 'asc')->get();
        $selected = Post::where(function ($query) use ($now) {
            $query->whereDate('date', '<=', $now)->orWhereNull('date');
        })->where('published', '1')->where('selected', '1')->first();

        $mainNews = Post::where('published', 1)
            ->orderBy('date', 'desc')
            ->first(); // Ամենավերջին հրապարակված նյութը

        $doctors = Post::where('published', 1)
            ->where('category_id', 3) // "ԻՄ ԲԺԻՇԿԸ" բաժնի ID
            ->orderBy('date', 'desc')
            ->take(12)
            ->get();

        $reclambanners = Reclam::where('type', 'banner')->where('page', 'index')->orderBy('id', 'desc')->get();


        $latestNews = Post::where('published', 1)
            ->where('selected', 0)
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();

        $mostRead = Post::where('published', 1)
            ->orderBy('votes', 'desc')
            ->take(3)
            ->get();




        return view('index')
            ->with('mainNews', $mainNews)
            ->with('doctors', $doctors)
            ->with('reclambanners', $reclambanners)
            ->with('latestNews', $latestNews)
            ->with('mostRead', $mostRead)


            ->with('category', $category)
            ->with('cats', $cats)
            ->with('topcats', $topcats)
            ->with('toppost', $toppost)
            ->with('mostviewed', $mostviewed)
            ->with('catnews', $catnews)
            ->with('banner', $banner)
            ->with('latest', $latest)
            ->with('videos', $video)
            ->with('reclamtops', $reclamtop)
            ->with('reclambottoms', $reclambottom)
            ->with('tops', $top)
            ->with('selected', $selected);

    }

    public function index()
    {
        $lastPost = Post::query()
            ->where('published', 1)
            ->orderBy('date', 'desc')
            ->firstOrFail();

        $lastPosts = Post::query()
            ->where('published', 1)
            ->where('id', '!=', $lastPost->id)
            ->orderBy('date', 'desc')
            ->take(9)
            ->get();

        $advertisements = Reclam::query()
            ->where('type', 'top')
            ->where('page', 'index')
            ->orderby('id', 'desc')
            ->get();

        $mostViewed = Post::query()
            ->where('published', 1)
            ->orderBy('votes', 'desc')
            ->take(3)
            ->get();

        $videos = Video::orderby('id', 'desc')->take(6)->get();

        return view('index')->with([
            'lastPost' => $lastPost,
            'lastPosts' => $lastPosts,
            'advertisements' => $advertisements,
            'mostViewed' => $mostViewed,
            'videos' => $videos,
        ]);
    }
    public function news()
    {
        $now = Carbon::now()->format('Y-m-d');

        // Վերջին նորությունները (որոնք ընտրովի չեն և հրապարակված են)
        $latestNews = Post::where('published', 1)
            ->where('selected', 0)
            ->whereHas('categories', function ($query) {
                $query->where('slug', 'norutyun');
            })
            ->orderBy('date', 'desc')
            ->paginate(6);

        // Ամենաշատ դիտված 3 նորությունները
        $mostRead = Post::where('published', 1)
            ->orderBy('votes', 'desc')
            ->take(3)
            ->get();

        // Բոլոր կատեգորիաները (առանց order/ordering սյան՝ եթե չկա)
        $category = Category::all();

        // Վերջին 5 տեսանյութերը
        $video = Video::orderBy('id', 'desc')->take(5)->get();

        // Բոլոր կատեգորիաների նորությունները (որոնք համապատասխան տվյալ կատեգորիայի են)
        $catnews = [];

        foreach ($category as $cat) {
            $catnews[] = $cat->posts()
                ->where(function ($query) use ($now) {
                    $query->whereDate('date', '<=', $now)
                        ->orWhereNull('date');
                })
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->take(3)
                ->get();
        }

        // Վերջին banner-ը
        $banner = Banner::orderBy('id', 'desc')->first();

        // Index էջի գովազդային banner-ները
        $reclambanners = Reclam::where('type', 'banner')
            ->where('page', 'index')
            ->orderBy('id', 'desc')
            ->get();

        // Բոլոր կատեգորիաները (եթե ordering սյունը չես օգտագործում, ապա սա suffice է)
        $cats = Category::all();

        return view('news', compact(
            'latestNews',
            'mostRead',
            'category',
            'catnews',
            'video',
            'banner',
            'reclambanners',
            'cats'
        ));
    }


    public function interview()
    {
        $now = Carbon::now()->format('Y-m-d');

        $interviews = Post::where('published', 1)
            ->where('selected', 0)
            ->whereHas('categories', function ($query) {
                $query->where('title', 'Հարցազրույց');
            })
            ->orderBy('date', 'desc')
            ->paginate(6);

        $mostRead = Post::where('published', 1)
            ->orderBy('votes', 'desc')
            ->take(3)
            ->get();

        $category = Category::all();
        $video = Video::orderBy('id', 'desc')->take(5)->get();
        $banner = Banner::orderBy('id', 'desc')->first();
        $reclambanners = Reclam::where('type', 'banner')
            ->where('page', 'index')
            ->orderBy('id', 'desc')
            ->get();
        $cats = Category::orderBy('id', 'asc')->get();

        return view('interview', compact(
            'interviews',
            'mostRead',
            'category',
            'video',
            'banner',
            'reclambanners',
            'cats'
        ));
    }



    public function videos()
    {
        $video = Video::orderBy('id', 'desc')->take(20)->get(); // take(20) նշանակում է վերցնել միայն 20 վիդեո

        // Short video section (առավել կարճ տեսանյութեր)
        $shorts = Video::orderBy('id', 'desc')->paginate(5); // ✅ ոչ ->get() // take(5) կարճ տեսանյութերի համար

        return view('video', compact('video', 'shorts'));
    }

    public function show($id)
    {
        $post = Post::find($id); // Ընդհանուր Post մոդելի միջոցով

        if (!$post || !$post->published) {
            abort(404);
        }

        return view('show', compact('post'));
    }



}
