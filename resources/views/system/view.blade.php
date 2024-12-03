@extends('layouts.layout')

@section('title', $pageTitle)

@section('content')
<div class="p-8 md:lg:flex">
    <!--  Primera Columna -->
    <div class="w-full m-5 space-y-5 md:lg:mt-20 md:lg:w-4/6">
        <article class="p-10 rounded-md bg-base-200">
            <a class="mb-4 font-semibold badge badge-primary hover:underline"
                href="/category/{{$post->category->slug}}">{{$post->category->name}}</a>
            <h1 class="mb-5 text-3xl font-bold md:lg:text-5xl text-pretty">{{$post->title}}</h1>
            <div class="divider"></div>
            <div class="flex items-center justify-between mb-10">
                <div class="flex items-center space-x-3">
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
            <div class="flex items-center justify-center my-5">
                <img class="" src="{{config('app.url')}}/storage/{{$post->image}}" alt="img-post" />
            </div>
            <div class="p-2 my-5 prose max-w-none">
                {!! $post->body!!}
            </div>
        </article>

        <!-- Tags -->
        <div class="p-5 rounded-md bg-base-200">
            <h3 class="py-2 text-xl font-bold text-pretty">Etiquetas</h3>
            @foreach ($tags as $tag)
                <a class="font-semibold badge badge-secondary hover:underline" href="/tag/{{$tag->slug}}">{{$tag->name}}</a>
            @endforeach
        </div>

    </div>

    <div class="m-5 space-y-3 md:lg:mt-20 md:lg:w-2/6">

        <div class="p-5 rounded-md bg-base-200">
            <!-- Publicaciones -->
            <h3 class="py-2 text-xl font-bold text-pretty">Publicaciones relacionadas</h3>
            <div class="flex flex-col items-center">
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

    </div>
    @endsection
