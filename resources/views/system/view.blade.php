@extends('layouts.layout')

@section('title', $pageTitle . ' - ' . config('app.name'))

@section('content')
<div class="flex gap-2 p-8">
    <!--  Primera Columna -->
    <div class="w-2/3 mt-20">
        <article>
            <h1 class="py-5 text-3xl font-bold md:lg:text-5xl text-pretty">{{$post->title}}</h1>
            <div class="flex items-center justify-center py-5">
                <img class="" src="{{config('app.url')}}/storage/{{$post->image}}" alt="img-post" />
            </div>
            <a class="badge badge-primary hover:underline"
                href="/category/{{$post->category->slug}}">{{$post->category->name}}</a>
            <div class="flex items-center justify-between py-5">
                <div class="flex items-center space-x-3">
                    <!-- Imagen del autor (opcional) -->
                    <x-filament::avatar src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->user) }}"
                        alt="user" />
                    <div>
                        <h3 class="text-sm font-semibold ">{{$post->user->name}}</h3>
                        <p class="text-xs">
                            {{ucfirst($post->created_at->translatedFormat('F j, Y g:i A'))}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="py-5 text-pretty">
                {!! $post->body!!}
            </div>
        </article>
        <div>
            <!-- Tags -->
            <div name="tags" class="py-2">
                <h3 class="py-2 text-xl font-bold text-pretty">Tags</h3>
                @foreach ($tags as $tag)
                    <a class="badge badge-primary hover:underline" href="/tag/{{$tag->slug}}">{{$tag->name}}</a>
                @endforeach
            </div>

            <div class="divider"></div>

            <!-- Comentarios -->
            <div name="comments" class="py-2">
                <h3 class="py-2 text-xl font-bold text-pretty">Comentarios</h3>
                <!--Formulario de comentario -->
                <form action="{{ route('comment') }}" method="post">
                    @csrf
                    <div class="form-control">
                        <input name="slug" class="hidden" value="{{$post->slug}}" />
                        <textarea name="body" class="textarea textarea-bordered" placeholder="Comentario"
                            required></textarea>
                        @error('body')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end mt-1 mb-3">
                        <button type="submit" class="btn btn-primary">Publicar</button>
                    </div>
                </form>
                @foreach ($comments as $comment)
                    <!-- Comentario -->
                    <div class="p-4 my-1 border rounded-md shadow-xl bg-base-100 border-neutral">
                        <!-- Encabezado del comentario -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <!-- Imagen del autor -->
                                <x-filament::avatar src="{{ \Filament\Facades\Filament::getUserAvatarUrl($comment->user) }}"
                                    alt="user" />
                                <div>
                                    <h3 class="text-sm font-semibold ">{{$comment->user->name}}</h3>
                                    <p class="text-xs">
                                        {{ucfirst($comment->created_at->translatedFormat('F j, Y g:i A'))}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Contenido del comentario -->
                        <p class="mt-3 text-sm leading-relaxed">
                            {{$comment->body}}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-20 divider divider-horizontal"></div>

    <!-- Segunda Columna -->
    <div class="w-1/3 mt-20">
        <!-- Publicaciones -->
        <h3 class="py-2 text-xl font-bold text-pretty">Publicaciones relacionadas</h3>
        @foreach ($related_post as $post)
            <x-post>
                <x-slot name="title">
                    {{$post->title}}
                </x-slot>
                <x-slot name="category">
                    {{$post->category->name}}
                </x-slot>
                <x-slot name="avatar">
                    {{$post->user}}
                </x-slot>
                <x-slot name="author">
                    {{$post->user->name}}
                </x-slot>
                <x-slot name="created_at">
                    {{ucfirst($post->created_at->translatedFormat('F j, Y g:i A'))}}
                </x-slot>
                <x-slot name="image">
                    {{config('app.url')}}/storage/{{$post->image}}
                </x-slot>
                <x-slot name="body">
                    {!! \Illuminate\Support\Str::words($post->body, 20, '...') !!}
                </x-slot>
                <x-slot name="slug">
                    {{$post->slug}}
                </x-slot>
            </x-post>
        @endforeach
    </div>
</div>
@endsection
