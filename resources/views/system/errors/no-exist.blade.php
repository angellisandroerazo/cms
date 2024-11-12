@extends('layouts.layout')

@section('title', 'Esta página no está disponible - '. config('app.name'))

@section('content')
<div class="flex flex-col items-center justify-center min-h-96">
    <div class="mt-20 text-center">
        <h2 class="py-5 text-5xl font-semibold">Esta página no está disponible</h2>
        <p>Es posible que el enlace esté roto o que se haya eliminado la página. Comprueba que el enlace que quieres abrir
            es correcto.</p>
    </div>
</div>
@endsection
