<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest();

        // if (request('search')) {
        //     $posts  
        //         ->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%')
        //         ->orWhere('author', 'like', '%' . request('search') . '%');
        // }

        return view('posts', [
            'posts' => $this->getPosts(),
            'categories' => Category::all()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }

    protected function getPosts()
    {
        return Post::latest()->filter(request(['search']))->get();
    }
}
