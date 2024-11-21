<footer class="p-10 mt-auto rounded footer footer-center bg-base-200 text-base-content">
    <nav class="grid grid-flow-col gap-4">
        <a class="link link-hover" href="/">Inicio</a>
        <a class="link link-hover" href="/posts">Posts</a>
        @if ($system->about)
            <a class="link link-hover" href="/about">{{$system->about_title}}</a>
        @endif
        @if ($system->contact)
            <a class="link link-hover" href="/contact">{{$system->contact_title}}</a>
        @endif
    </nav>
    <nav class="grid grid-flow-col gap-4">
        @foreach ($extra_pages as $page)
            <a class="link link-hover" href="/{{$page->slug}}">{{$page->title}}</a>
        @endforeach
    </nav>
    <aside>
        <p>&copy; {{ date('Y') }} {{config('app.name')}}.</p>
    </aside>
</footer>
