<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

use App\Models\Category;
use App\Models\Post;
use App\Models\Video;
use App\Models\Reclam;
use App\Models\Banner;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.index');
    }

    /*==SECTIONS==*/
    public function sections()
    {
        $cat = Category::all();
        $top = Category::where('top','1')->first();
        return view('admin.sections')
                ->with('cats',$cat)
                ->with('top',$top);
    }
    public function saveorders(Request $request)
    {
        $cat = Category::find($request->input('id'));
    	if(!$cat){
            return redirect()->back();
    	}

    	$cat->orders = $request->input('orders');


        $cat->save();

    	return redirect()->back();
    }
    public function changesections($id)
    {
        $cat = Category::where('id',$id)->first();
        if($cat->visible == 1){
            $cat->visible = 0;
        }else{
            $cat->visible = 1;
        }
        $cat->save();
        return redirect('/adminsections');
    }
    public function settop($id)
    {
        $top = Category::where('top','1')->first();
        $top->top = 0;
        $top->save();
        $cat = Category::where('id',$id)->first();
        $cat->top = 1;
        $cat->save();
        return redirect('/adminsections');
    }
    /*==POSTS==*/
    public function adminallposts()
    {
        $post = Post::orderby('id','desc')->get();
        $search = 'noresult';
        return view('admin.posts')
                ->with('search',$search)
                ->with('posts',$post);
    }
    public function deletepost($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect('/adminallposts');
        }
        if($post->img != null){
            unlink(public_path('images/posts/' . $post->img));
        }
        if($post->gallery != null){
            $gal = explode(",",$post->gallery);
            foreach ($gal as $gal){
                unlink(public_path('images/posts/' . $gal));
            }
        }
        $post->delete();
        return redirect("/adminallposts");
    }
    public function adminnewpost()
    {
        $cat = Category::all();
        return view('admin.postsform')->with('cats',$cat);
    }
    public function newpost(Request $request)
    {
        $post = new Post;

        $post->title = $request->input('title');
        $post->anons = $request->input('anons');
        $post->description = $request->input('description');
        $post->votes = $request->input('votes');
        $post->date = $request->input('date');
        if(!$request->input('votes')){
            $post->votes = 0;
        }
        if($request->file('img')){
            $img = $request->file('img');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save( public_path('images/posts/' . $filename));
            $post->img = $filename;
        }

        if($request->file('images')){
            $files = $request->file('images');
            $imgname = array();
            foreach ($files as $file) {
                $avatar = $file;
                $filename  = time().$file->getClientOriginalName();
                $img = Image::make($avatar);
                    $img->save( public_path('images/posts/' . $filename));
                $imgname[] = $filename;
            }
            if($imgname){
            $gallery = implode(',', $imgname);
            }else{
               $gallery  = null;
            }
            $post->gallery = $gallery;
        }else{
            $post->gallery = null;
        }
        $post->top = $request->input('top');
        if(!$request->input('top')){
            $post->top = 0;
        }
        $post->slide = $request->input('slide');
        if(!$request->input('slide')){
            $post->slide = 0;
        }
        $post->published = $request->input('published');
        if(!$request->input('published')){
            $post->published = 0;
        }
        $post->category_id = $request->input('cat');
        if(!$request->input('cat')){
            $post->category_id = 0;
        }
        $post->new_cat = $request->input('new_cat');
        if(!$request->input('new_cat')){
            $post->new_cat = null;
        }
        $post->save();

    //    return redirect("/test");
        return redirect("/adminallposts");
    }
    public function test()
    {
        $post = Post::orderby('id','desc')->first();
        return view('admin.test')->with('post',$post);
    }
    public function admineditpost($id)
    {
        $post = Post::where('id',$id)->first();
        $cat = Category::all();
        $gallery = $post->gallery;
        $gal = explode(",",$gallery);
        if($post->new_cat != null){
            $choosen = Category::where('id',$post->new_cat)->first();
        }else{
            $choosen = null;
        }
        return view('admin.editform')
                ->with('gals',$gal)
                ->with('choosen',$choosen)
                ->with('cats',$cat)
                ->with('post',$post);
    }
    public function deletegal($id,$img)
    {
        $post = Post::find($id);


        $gallery = $post->gallery;



        $gal = explode(",",$gallery);


        $key = array_search($img, $gal);

        unset($gal[$key]);
        unlink(public_path('images/posts/' . $img));

        $post->gallery = implode(",", $gal);

        $post->save();

        return redirect()->back();
    }
    public function savepost(Request $request)
    {
        $post = Post::find($request->input('id'));
    	if(!$post){
            return redirect()->back();
    	}

    	$post->title = $request->input('title');
        $post->anons = $request->input('anons');
        $post->description = $request->input('description');
        $post->votes = $request->input('votes');
        $post->date = $request->input('date');
        if (!$request->input('votes')) {
            $post->votes = 0;
        }
        if ($request->file('img')) {
            $img = $request->file('img');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save(public_path('images/posts/' . $filename));
            $post->img = $filename;
        }else{
            $post->img = $request->input('hiddenimg');
        }

        if ($request->file('images')) {
            $files = $request->file('images');
            $imgname = array();
            foreach ($files as $file) {
                $avatar = $file;
                $filename = time() . $file->getClientOriginalName();
                $img = Image::make($avatar);
                $img->save(public_path('images/posts/' . $filename));
                $imgname[] = $filename;
            }
            if ($imgname) {
                $gallery = implode(',', $imgname);
            } else {
                $gallery = null;
            }
            $post->gallery = $gallery;
        } else {
            $post->gallery = $request->input('hiddengal');
        }
        $post->top = $request->input('top');
        if (!$request->input('top')) {
            $post->top = 0;
        }
        $post->slide = $request->input('slide');
        if (!$request->input('slide')) {
            $post->slide = 0;
        }
        $post->published = $request->input('published');
        if (!$request->input('published')) {
            $post->published = 0;
        }
        $post->category_id = $request->input('cat');
        if (!$request->input('cat')) {
            $post->category_id = 0;
        }
        $post->new_cat = $request->input('new_cat');
        if (!$request->input('new_cat')) {
            $post->new_cat = null;
        }
        $post->save();

    	return redirect()->back();
    }
    /*==VIDEOS==*/
    public function adminallvideos()
    {
        $video = Video::orderby('id','desc')->get();
        return view('admin.videos')->with('videos',$video);
    }

    public function deletevideo($id)
    {
        $video = Video::find($id);
        if (!$video) {
            return redirect('/adminallvideo');
        }
        unlink(public_path('images/videos/' . $video->img));
        $video->delete();
        return redirect("/adminallvideo");
    }

    public function adminnewvideo() {
        return view('admin.videosform');
    }
    public function newvideo(Request $request) {
        $video = new Video;

        $video->title = $request->input('title');
        $video->iframe = $request->input('iframe');
        $video->description = $request->input('description');
        if($request->file('img')){
            $img = $request->file('img');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save( public_path('images/videos/' . $filename));
            $video->img = $filename;
        }
        $video->save();
        return redirect('/adminallvideo');
    }
    public function admineditvideo($id) {
        $video = Video::where('id',$id)->first();
        return view('admin.editvideo')->with('video',$video);
    }
    public function savevideo(Request $request) {
        $video = Video::find($request->input('id'));
    	if(!$video){
            return redirect()->back();
    	}

    	$video->title = $request->input('title');
    	$video->iframe = $request->input('iframe');
    	$video->description = $request->input('description');
        if ($request->file('img')) {
            $img = $request->file('img');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save(public_path('images/videos/' . $filename));
            $video->img = $filename;
        }else{
            $video->img = $request->input('hiddenimg');
        }
        $video->save();

    	return redirect('/adminallvideo');
    }
    /*==RECLAMS==*/
    public function adminallreclam()
    {
        $reclam = Reclam::all();
        return view('admin.reclams')->with('reclams',$reclam);
    }
    public function deletereclam($id)
    {
        $reclam = Reclam::find($id);
        if (!$reclam) {
            return redirect('/adminallreclam');
        }
        unlink(public_path('images/reclam/' . $reclam->img));
        $reclam->delete();
        return redirect("/adminallreclam");
    }
    public function adminnewreclam() {
        return view('admin.reclamsform');
    }
    public function newreclam(Request $request) {
        $reclam = new Reclam;

        $reclam->href = $request->input('href');
        $reclam->type = $request->input('type');
        $reclam->page = $request->input('page');
        if($request->file('img')){
            $img = $request->file('img');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save( public_path('images/reclam/' . $filename));
            $reclam->img = $filename;
        }
        $reclam->save();
        return redirect('/adminallreclam');
    }
    /*==BANNER==*/
    public function adminallbanner()
    {
        $banner = Banner::orderby('id','desc')->first();
        return view('admin.banners')->with('banner',$banner);
    }
    public function adminnewbanner() {
        return view('admin.bannersform');
    }
    public function newbanner(Request $request) {
        $banner = new Banner;

        if($request->file('img')){
            $img = $request->file('img');
            $filename = time() . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save( public_path('images/' . $filename));
            $banner->img = $filename;
        }
        $banner->save();
        return redirect('/adminallbanner');
    }
    /*==SELECTED==*/
    public function setunselected($id) {
        $post = Post::where('id',$id)->first();
        $post->selected = 0;
        $post->save();
        return redirect('/adminallposts');
    }
    public function setselected($id) {
        $post = Post::where('id',$id)->first();
        $post->selected = 1;
        $post->save();
        return redirect('/adminallposts');
    }
}
