@extends('layouts.layout')

@section('title', 'Inicio')

@section('content')
<div class="min-h-screen hero"
    style="background-image: url({{config('app.url')}}/storage/{{$info_site->landing_image}});">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="text-center hero-content text-neutral-content">
        <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold">{{$info_site->landing_title}}</h1>
            <p class="mb-5">
                {{$info_site->landing_body}}
            </p>
            <a class="btn btn-primary" href="/posts">Ver posts</a>
        </div>
    </div>
</div>
@endsection
