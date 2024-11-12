<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()) {
            $validatedData = $request->validate([
                'body' => 'required|string|max:200',
                'slug' => 'required|string|max:190',
            ], [
                'body.required' => 'Para publicar el comentario, llene el campo.',
                'body.string' => 'El campo debe ser texto.',
                'body.max' => 'El comentario no puede exceder 200 caracteres.',
            ]);

            try {

                $post_id = Post::where('slug', $validatedData['slug'])->value('id');


                $comment = Comment::create([
                    'body' => $validatedData['body'],
                    'author_id' => auth()->user()->id,
                    'post_id' => $post_id,
                ]);
                return redirect(url("/{$validatedData['slug']}"));
            } catch (Exception $e) {
                return view('system.errors.error', ['error' => $e->getCode()]);
            }
        }

        return redirect(url(config('app.url') . '/dashboard'));
    }
}
