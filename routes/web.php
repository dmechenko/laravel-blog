<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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

// Route::get('/', function () {
//     return view('posts', [
//         'posts' => Post::latest()->get(),
//         'categories' => Category::all()
//         // 'posts' => Post::latest()->with('category', 'author')->get()
//     ]);
// })->name('home');

Route::get('/', [PostController::class, 'index'])->name('home');

// Route::get('posts/{post:slug}', function (Post $post){
//     return view('post', [
//         'post' => $post
//     ]);
// });

Route::get('posts/{post:slug}', [PostController::class, 'show']);

// Route::get('categories/{category:slug}', function(Category $category){
//     return view('posts', [
//         'posts' => $category->posts,
//         'currentCategory' => $category,
//         'categories' => Category::all()
//         // 'posts' => $category->posts->load(['category', 'author'])
//     ]);
// })->name('category');

// Route::get('authors/{author:username}', function(User $author){
//     return view('posts.index', [
//         'posts' => $author->posts,
//         // 'categories' => Category::all()
//         // 'posts' => $author->posts->load(['category', 'author'])
//     ]);
// });

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);