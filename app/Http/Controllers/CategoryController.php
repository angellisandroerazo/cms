<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewPosts($category)
    {
        $id_category = Category::where('slug', $category)->value('id');

        if (!$id_category) {
            return view("system.errors.no-exist");
        }

        $category = Category::find($id_category);

        $posts = Post::select('id', 'title', 'slug', 'image', 'category_id', 'created_at')
            ->where('category_id', $id_category)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($posts->isEmpty()) {
            return view("system.errors.no-data");
        }

        return view("system.posts-category", compact("posts"), [
            "pageTitle" => ucfirst($category->name),
            "pageDescription" => $category->description
        ]);
    }

}


