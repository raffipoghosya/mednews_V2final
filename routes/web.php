<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/init-db', function () {
    if (!Category::count()) {
        $categories = [
            ['title' => 'Հարցազրույց', 'slug' => 'harcazruyc', 'sorting' => 1],
            ['title' => 'Նորություն', 'slug' => 'norutyun', 'sorting' => 2],
        ];

        foreach ($categories as $data) {
            Category::create($data);
        }

        $category1 = Category::where('slug', 'harcazruyc')->first();
        $category2 = Category::where('slug', 'norutyun')->first();

        if ($category1 && $category2) {
            $posts = Post::all();
            foreach ($posts as $post) {
                if ($post->category_id === 4) {
                    $post->categories()->syncWithoutDetaching([$category1->id]);
                }
                $post->categories()->syncWithoutDetaching([$category2->id]);
            }
        }
    } else {
        die('arden araca');
    }


});

Route::get('/', [IndexController::class, 'index']);

Route::get('/news', [IndexController::class, 'news']);
Route::get('/interview', [IndexController::class, 'interview']);
Route::get('/videos', [IndexController::class, 'videos']);


Route::get('/single/{id}', [IndexController::class, 'show'])->name('news.show');




// Route::get('/single/{id}', [SingleController::class, 'index']);
Route::get('/catpage/{id}', [CatController::class, 'index']);

Route::post('/search', [SearchController::class, 'index']);
Route::post('/datesearch', [SearchController::class, 'datesearch']);
Route::post('/adsearch', [SearchController::class, 'adsearch']);

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/adminsections', [AdminController::class, 'sections']);
Route::get('/changesection/{id}', [AdminController::class, 'changesections']);
Route::get('/settop/{id}', [AdminController::class, 'settop']);
Route::post('/saveorders', [AdminController::class, 'saveorders']);

Route::get('/adminallposts', [AdminController::class, 'adminallposts']);
Route::get('/deletepost/{id}', [AdminController::class, 'deletepost']);
Route::get('/adminnewpost', [AdminController::class, 'adminnewpost']);
Route::post('/newpost', [AdminController::class, 'newpost']);
Route::get('/test', [AdminController::class, 'test']);
Route::get('/admineditpost/{id}', [AdminController::class, 'admineditpost']);
Route::get('/deletegal/{id}/{img}', [AdminController::class, 'deletegal']);
Route::post('/savepost', [AdminController::class, 'savepost']);

Route::get('/adminallvideo', [AdminController::class, 'adminallvideos']);
Route::get('/deletevideo/{id}', [AdminController::class, 'deletevideo']);
Route::get('/adminnewvideo', [AdminController::class, 'adminnewvideo']);
Route::post('/newvideo', [AdminController::class, 'newvideo']);
Route::get('/admineditvideo/{id}', [AdminController::class, 'admineditvideo']);
Route::post('/savevideo', [AdminController::class, 'savevideo']);

Route::get('/adminallreclam', [AdminController::class, 'adminallreclam']);
Route::get('/deletereclam/{id}', [AdminController::class, 'deletereclam']);
Route::get('/adminnewreclam', [AdminController::class, 'adminnewreclam']);
Route::post('/newreclam', [AdminController::class, 'newreclam']);

Route::get('/adminallbanner', [AdminController::class, 'adminallbanner']);
Route::get('/adminnewbanner', [AdminController::class, 'adminnewbanner']);
Route::post('/newbanner', [AdminController::class, 'newbanner']);

Route::get('/setunselected/{id}', [AdminController::class, 'setunselected']);
Route::get('/setselected/{id}', [AdminController::class, 'setselected']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
