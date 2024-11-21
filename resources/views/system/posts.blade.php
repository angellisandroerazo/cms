@extends('layouts.layout')

@section('title', 'Posts')

@section('content')
<div class="flex items-center justify-around w-full">
    <div class="grid grid-cols-1 mt-20 md:lg:grid-cols-3">
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
<div class="flex items-center justify-center">
    {{ $posts->links('vendor.pagination.custom') }}
</div>
@endsection
