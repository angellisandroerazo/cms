<div class="fixed z-10 shadow-md navbar bg-base-100">
    <div class="navbar-start">
        <a href="/" class="text-xl normal-case btn btn-ghost"> <img class="w-8 h-8" src="/images/favicon_io/favicon.ico"
                alt="Logo" /> {{config('app.name')}}</a>
    </div>

    <div class="navbar-center">

    </div>

    <div class="navbar-end">
        <div class="flex items-center space-x-3">
            <button @click="toggleTema()" class="p-1 rounded-full bg-base-200">
                <svg x-show="tema === 'customLight'" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-gray-500"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg x-show="tema === 'customDark'" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-yellow-500"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
            @if(Auth::check())
                <div class="dropdown dropdown-end">
                    <x-filament::avatar src="{{ \Filament\Facades\Filament::getUserAvatarUrl(Auth::user()) }}" alt="user"
                        tabindex="0" role="button" />
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        <li><a href="{{config('app.url')}}/dashboard">Dashboard</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li>
                                <a onclick="event.preventDefault();this.closest('form').submit();"
                                    href="{{ route('logout') }}">Logout</a>
                            </li>
                        </form>
                    </ul>
                </div>
            @else
                <a class="link link-accent" href="{{config('app.url')}}/dashboard">Iniciar sesion</a>
            @endif
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="p-2 mt-5 shadow-lg menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/posts">Posts</a></li>
                    <li>
                        <details>
                            <summary>Categoria</summary>
                            <ul class="p-2 rounded-t-none bg-base-100">
                                @foreach ($categories as $category)
                                    <li><a href="/category/{{$category->slug}}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
