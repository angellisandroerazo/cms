<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    tema: localStorage.getItem('tema') || 'customLight',
    toggleTema() {
        this.tema = this.tema === 'customLight' ? 'customDark' : 'customLight';
        localStorage.setItem('tema', this.tema);
    }
}" x-init="$watch('tema', value => document.documentElement.setAttribute('data-theme', value))"
    x-bind:data-theme="tema">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon_io/favicon-16x16.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>
