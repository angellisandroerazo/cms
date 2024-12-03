<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Taggable;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function viewPosts($tag)
    {
        $id_tag = Tag::where('slug', $tag)->value('id');

        // Si no existe el tag, muestra un error
        if (!$id_tag) {
            return view("system.errors.no-exist");
        }

        $tag = Tag::find($id_tag);

        $id_posts = Taggable::where('tag_id', $id_tag)->pluck('post_id');

        if ($id_posts->isEmpty()) {
            return view("system.errors.no-data");
        }

        $posts = Post::whereIn('id', $id_posts)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view(
            "system.posts-tag",
            compact("posts"),
            ["pageTitle" => ucfirst($tag->name)]
        );
    }
}
