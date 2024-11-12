<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function viewPosts($category)
{
    // Obtén el ID de la categoría a partir del slug
    $id_category = Category::where('slug', $category)->value('id');

    // Si no existe el ID de la categoría, muestra la vista de error
    if (!$id_category) {
        return view("system.errors.no-exist");
    }

    // Obtiene la categoría completa para el título de la página
    $category = Category::find($id_category);

    // Obtiene los posts de la categoría que están publicados
    $posts = Post::where('category_id', $id_category)
        ->where('is_published', true)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    // Si no hay posts en la categoría, muestra la vista de error de datos
    if ($posts->isEmpty()) {
        return view("system.errors.no-data");
    }

    // Retorna la vista con los posts y el título de la página
    return view("system.posts-category", compact("posts"), [
        "pageTitle" => ucfirst($category->name)
    ]);
}

}
