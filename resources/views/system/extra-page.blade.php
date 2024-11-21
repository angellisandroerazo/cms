@extends('layouts.layout')

@section('title', $extra_page->title)
@section('content')
<div class="flex flex-col items-center justify-center p-8">
    <!-- Primera Columna -->
    <div class="w-full mt-10 space-y-10 md:w-3/5">
        <!-- Título y descripción -->
        <div>
            <h1 class="mb-6 text-4xl font-bold md:text-6xl lg:text-6xlxl text-pretty">
                {{$extra_page->title}}
            </h1>
            <div class="p-2 my-5 prose max-w-none">
                {!! $extra_page->body!!}
            </div>
        </div>
    </div>
</div>

@endsection
