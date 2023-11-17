<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\Video;
use App\Models\Reclam;
use Carbon\Carbon;

class CatController extends Controller
{
    public function index($id) {
        $now = Carbon::now()->format('Y-m-d');
        $cat = Category::where('id',$id)->first();
        $recomented = Post::where(function($query) use ($now){
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->orderby('date','desc')->where('category_id',$id)->orwhere('new_cat',$id)->Paginate(10);
        $mostviewed = Post::where(function($query) use ($now){
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->orderby('votes','desc')->take(4)->get();
        $latest = Post::where(function($query) use ($now){
                $query->whereDate('date', '<=', $now)->orWhereNull('date');
            })->orderby('date','desc')->take(10)->get();
        $cats = Category::all();
        $video = Video::all();
        $reclamtop = Reclam::where('type','top')->where('page','single')->orderby('id','desc')->get();
        $reclambottom = Reclam::where('type','bottom')->where('page','single')->orderby('id','desc')->get();
        return view('catpage')
            ->with('reclamtops',$reclamtop)
            ->with('reclambottoms',$reclambottom)
            ->with('cattitle',$cat)
            ->with('videos',$video)
            ->with('cats',$cats)
            ->with('mostviewed',$mostviewed)
            ->with('latest',$latest)
            ->with('recomented',$recomented);
    }
}
