<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view("system.posts", compact("posts"));
    }

    public function view($slug)
    {
        $post = Post::where('is_published', true)
            ->where('slug', $slug)->first();
        return view("system.view", compact("post"));
    }

    public function viewCategory($slug)
    {
        $post = Post::where('is_published', true)
            ->where('category_id', $slug)->first();
        return view("system.view", compact("post"));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
