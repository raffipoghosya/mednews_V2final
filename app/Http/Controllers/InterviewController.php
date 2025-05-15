<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Video;
use App\Models\Reclam;
use Carbon\Carbon;

class InterviewController extends Controller
{
    public function index()
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
    public function news()
    {
        return view('news');

    }
}
