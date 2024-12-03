@extends('layouts.layout')

@section('title', $pageTitle)

@section('content')
<x-title title={{$pageTitle}} subtitle="Categoría" />
<div class="flex items-center justify-center my-10">
    <div class="w-full lg:md:w-3/5">
        <p class="text-base">
            {{$pageDescription}}
        </p>
    </div>

</div>
<div class="flex items-center justify-around w-full">
    <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3">
        @foreach ($posts as $post)
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
<div class="flex items-center justify-center">
    {{ $posts->links('vendor.pagination.custom') }}
</div>
@endsection
