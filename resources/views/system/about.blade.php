@extends('layouts.layout')

@section('title', $about->about_title)
@section('content')
<x-title title="{{$about->about_title}}" subtitle=""/>
<div class="flex flex-col items-center justify-center p-8">
    <div class="w-full mt-10 space-y-10 lg:md:w-3/5">
        <div>
            <div class="p-2 prose max-w-none">
                {!! $about->about_body!!}
            </div>
        </div>
    </div>
</div>

@endsection
