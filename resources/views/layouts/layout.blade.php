<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    tema: localStorage.getItem('tema') || 'corporate',
    toggleTema() {
        this.tema = this.tema === 'corporate' ? 'business' : 'corporate';
        localStorage.setItem('tema', this.tema);
    }
}" x-init="$watch('tema', value => document.documentElement.setAttribute('data-theme', value))"
    x-bind:data-theme="tema">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <!-- Header -->
    @include('templates.header')

    <!-- Contenido Principal -->

    <section>
        @yield('content')
    </section>

    <!-- Footer -->
    @include('templates.footer')

</body>

</html>
