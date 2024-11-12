<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($posts->isEmpty()) {
            return view("system.errors.no-data");
        }

        return view("system.posts", compact("posts"));
    }

    public function view($slug)
    {
        $post = Post::where('is_published', true)
            ->where('slug', $slug)->first();

        if (!$post) {
            return view("system.errors.no-exist");
        }

        $comments = Comment::where('post_id', $post->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)->get();

        $taggable = Taggable::where('post_id', $post->id)->pluck('tag_id');

        $tags = Tag::whereIn('id', $taggable)->get();

        $related_post  = Post::where('is_published', true)
            ->where('slug', '!=', $slug)
            ->where('category_id', $post->category_id)
            ->orderBy('created_at', 'desc')
            ->limit(5)->get();

        return view(
            "system.view",
            compact("post", "tags", "comments", "related_post"),
            ["pageTitle" => $post->title]
        );
    }
}
