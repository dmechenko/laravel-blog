<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        return view('posts.index', [
            'posts' => $this->getPosts(),
            // 'categories' => Category::all(),
            'currentCategory' => Category::firstWhere('slug', request('category'))
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {   
        return view('posts.create');
    }

    protected function getPosts()
    {
        return Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString();
    }
}
