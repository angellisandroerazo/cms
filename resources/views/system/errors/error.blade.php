@extends('layouts.layout')

@section('title', 'Error - '. config('app.name'))

@section('content')
<div class="flex flex-col items-center justify-center min-h-96">
    <div class="mt-20 text-center">
        <h2 class="py-5 text-5xl font-semibold">Error</h2>
        <p>{{$error}}</p>
    </div>
</div>
@endsection
