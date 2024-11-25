@extends('layouts.layout')

@section('title', $extra_page->title)
@section('content')
<x-title title="{{$extra_page->title}}" subtitle=""/>
<div class="flex flex-col items-center justify-center p-8">
    <div class="w-full mt-10 space-y-10 md:w-3/5">
        <div>
            <div class="p-2 prose max-w-none">
                {!! $extra_page->body!!}
            </div>
        </div>
    </div>
</div>

@endsection
