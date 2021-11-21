<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\services\Newsletter;
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

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', function(Newsletter $newsletter) {
  request()->validate(['email' => "required|email"]);

  try {
    $newsletter->subscribe(request('email'));
  } catch (\Exception $e) {
    \Illuminate\Validation\ValidationException::withMessages([
      'email' => 'This email could not be added.'
    ]);
  }
  return redirect('/')->with('success', "You're now signed up for our newsletter!");
});

Route::get('admin/posts/create', [PostController::class, 'create'])->middleware('admin');
Route::post('admin/posts', [PostController::class, 'store'])->middleware('admin');

