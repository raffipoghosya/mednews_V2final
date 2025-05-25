<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Reclam;
use Carbon\Carbon;

class SingleController extends Controller
{
    public function index($id) {
        $now = Carbon::now()->format('Y-m-d');
        $post = Post::where('id',$id)->first();
        $recomented = Post::where(function($query) use ($now){
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->orderby('date','desc')->where('published','1')->where('category_id',$post->category_id)->take(5)->get();
        $mostviewed = Post::where(function($query) use ($now){
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->where('published','1')->orderby('votes','desc')->take(5)->get();
        $latest = Post::where(function($query) use ($now){
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->where('published','1')->orderby('date','desc')->take(10)->get();
        $cats = Category::all();
        $reclamtop = Reclam::where('page','single')->where('type','top')->get();
        $reclambottom = Reclam::where('page','single')->where('type','bottom')->get();
        $gallery = $post->gallery;
        $gal = explode(",",$gallery);
        $test = "test";
        
        return view('single')
            ->with('test',$test)
            ->with('post',$post)
            ->with('cats',$cats)
            ->with('gals',$gal)
            ->with('mostviewed',$mostviewed)
            ->with('latest',$latest)
            ->with('reclamtops',$reclamtop)
            ->with('reclambottoms',$reclambottom)
            ->with('recomented',$recomented);
    }
}
