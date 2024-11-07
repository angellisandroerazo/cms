<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category)
    {
        $id_category = Category::where('slug', $category)->pluck('id');
        $posts = Post::where('category_id', $id_category)
            ->paginate(10);
        return view("system.posts-category", compact("posts"));
    }
}
