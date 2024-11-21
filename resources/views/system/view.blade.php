@extends('layouts.layout')

@section('title', $pageTitle)

@section('content')
<div class="p-8 md:lg:flex">
    <!--  Primera Columna -->
    <div class="w-full mt-20 md:lg:w-4/6">
        <article>
            <h1 class="my-5 text-3xl font-bold md:lg:text-5xl text-pretty">{{$post->title}}</h1>
            <div class="flex items-center justify-center my-5">
                <img class="" src="{{config('app.url')}}/storage/{{$post->image}}" alt="img-post" />
            </div>
            <a class="my-5 badge badge-primary hover:underline"
                href="/category/{{$post->category->slug}}">{{$post->category->name}}</a>
            <div class="flex items-center justify-between my-5">
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
            <div class="p-2 my-5 prose max-w-none">
                {!! $post->body!!}
            </div>

        </article>
        <div>
            <!-- Tags -->
            <div name="tags" class="my-2">
                <h3 class="py-2 text-xl font-bold text-pretty">Tags</h3>
                @foreach ($tags as $tag)
                    <a class="badge badge-primary hover:underline" href="/tag/{{$tag->slug}}">{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    </div>



    <div class="mt-20 divider divider-horizontal"></div>

    <!-- Segunda Columna -->
    <div class="md:lg:mt-20 md:lg:w-2/6">
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
                <x-slot name="created_at">
                    {{ucfirst($post->created_at->translatedFormat('F j, Y g:i A'))}}
                </x-slot>
                <x-slot name="image">
                    {{config('app.url')}}/storage/{{$post->image}}
                </x-slot>
                <x-slot name="slug">
                    {{$post->slug}}
                </x-slot>
            </x-post>
        @endforeach
    </div>
</div>
@endsection
