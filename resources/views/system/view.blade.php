@extends('layouts.layout')

@section('content')
<div class="flex items-center justify-center p-8">
    <div class="w-3/5">
        <div class="flex justify-end gap-3">
            <div class="badge badge-primary">{{$post->user->name}}</div>
            <div class="badge badge-primary">{{ucfirst($post->created_at->translatedFormat('F j, Y g:i A'))}}</div>
            <div class="badge badge-primary">{{$post->category->name}}</div>
        </div>
        <div class="p-5">
            <h1 class="text-5xl font-bold">{{$post->title}}</h1>
        </div>
        <div class="p-3">
            <img class="" src="{{config('app.url')}}/storage/{{$post->image}}" alt="img-post" />
        </div>
        <div class="p-3">
            {!! $post->body!!}
        </div>

    </div>
</div>
@endsection
