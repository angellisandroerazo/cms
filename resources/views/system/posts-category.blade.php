@extends('layouts.layout')

@section('content')
@if ($posts->isEmpty())
    <x-empty />
@endif
<div class="flex justify-around items-center w-full">
    <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3">
        @foreach ($posts as $post)
            <x-post>
                <x-slot name="title">
                    {{$post->title}}
                </x-slot>
                <x-slot name="category">
                    {{$post->category->name}}
                </x-slot>
                <x-slot name="author">
                    {{$post->user->name}}
                </x-slot>
                <x-slot name="created_at">
                    {{ucfirst($post->created_at->format('M j, Y'))}}
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
<div class="flex justify-center items-center">
    {{ $posts->links('vendor.pagination.custom') }}
</div>
@endsection
