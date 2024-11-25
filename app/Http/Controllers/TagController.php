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
        // Obtiene el ID del tag a partir del slug
        $id_tag = Tag::where('slug', $tag)->value('id'); // usa 'value' para obtener solo un ID

        // Si no existe el tag, muestra un error
        if (!$id_tag) {
            return view("system.errors.no-exist");
        }

        // Obtiene el tag completo para el título de la página
        $tag = Tag::find($id_tag);

        // Obtiene los IDs de los posts asociados al tag
        $id_posts = Taggable::where('tag_id', $id_tag)->pluck('post_id');

        // Si no hay posts asociados al tag, muestra un error
        if ($id_posts->isEmpty()) {
            return view("system.errors.no-data");
        }

        // Obtiene los posts publicados que están asociados al tag
        $posts = Post::whereIn('id', $id_posts) // usa whereIn para una colección de IDs
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Retorna la vista con los posts y el título de la página
        return view(
            "system.posts-tag",
            compact("posts"),
            ["pageTitle" => ucfirst($tag->name)]
        );
    }
}
