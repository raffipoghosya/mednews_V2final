<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function index() {
        $now = Carbon::now()->format('Y-m-d');
        $search = Request::input('search');
        $post = Post::where(function($query) use ($now){
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->where('title', 'LIKE', "%$search%")->orwhere('description', 'LIKE', "%$search%")->get();
        $cats = Category::orderby('ordering','asc')->get();
        return view('search')
                ->with('cats',$cats)
                ->with('posts',$post);
    }
    public function datesearch() {
        $now = Carbon::now()->format('Y-m-d');
        $search = Request::input('date');
        $post = Post::where(function($query) use ($now){
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->where('date', 'LIKE', "%$search%")->get();
        $cats = Category::orderby('ordering','asc')->get();
        return view('search')
                ->with('cats',$cats)
                ->with('posts',$post);
    }
    public function adsearch() {
        $search = Request::input('adsearch');
        $post = Post::where('title', 'LIKE', "%$search%")->orwhere('description', 'LIKE', "%$search%")->get();
        $cats = Category::orderby('ordering','asc')->get();
        return view('admin.posts')
                ->with('cats',$cats)
                ->with('search',$post);
    }
}
