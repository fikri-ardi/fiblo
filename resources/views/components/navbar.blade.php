<div>
    {{-- Desktop navigation --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white bg-opacity-50 p-4 z-50 w-full top-0 backdrop-blur-xl">
        <div class="container flex justify-content-between">
            {{-- Application logo --}}
            <div>
                <a class="flex items-center text-red-500 font-bold hover:text-red-500" href="/">
                    <span class="text-2xl sm:text-4xl">{{ config('app.name') }}</span>
                </a>
            </div>
    
            {{-- Navigation menu --}}
            <div class="collapse navbar-collapse flex-grow-0 -ml-14" id="navbarNav">
                <ul class="navbar-nav">
                    @foreach ($desktop as $name => $value)
                    <li class="nav-item px-3">
                        <a class="nav-link{{ $value['isActive'] ? ' active' : '' }}" href="{{ $value['route'] }}">{{ $name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
    
            {{-- Right Nav --}}
            <ul x-data="{ open: false }" class="navbar-nav space-x-2">
                @auth
                <li class="hidden sm:inline-block nav-item relative">
                    <a href="{{ route('user_posts.create') }}"
                        class="flex items-center justify-center bg-slate-200 rounded-full h-8 w-8 active:bg-slate-400">
                        <i class="bi bi-pencil-square text-xl font-bold"></i>
                    </a>
                </li>
    
                <li class="nav-item relative">
                    {{-- Nav Toggler --}}
                    <div class="flex items-center cursor-pointer active:bg-slate-300 hover:bg-slate-200 rounded-full pr-2 transition"
                        x-on:mouseover="open = true">
                        <div class="w-8 h-8 mr-1 rounded-full">
                            <x-_photo :user="auth()->user()"></x-_photo>
                        </div>
                        <i class="bi bi-chevron-down"></i>
    
                        {{-- Dropdown Content --}}
                        <ul x-show="open" x-on:mouseleave="open = false" x-transition
                            class="absolute shadow-lg rounded-xl right-0 top-12 overflow-hidden z-50 bg-white min-w-full w-44">
                            <x-_list-link :href="route('users.show', auth()->user())">
                                <i class="bi bi-person text-lg mr-2"></i> Profil
                            </x-_list-link>
                            @can('role', 'founder')
                            <x-_list-link :href="route('dashboard')">
                                <i class="bi bi-layout-text-sidebar-reverse mr-2"></i> Dashboard
                            </x-_list-link>
                            @endcan
                            <x-_list-link :href="route('password.edit')">
                                <i class="bi bi-shield-lock mr-2"></i> Ubah Password
                            </x-_list-link>
    
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="flex items-center px-3 py-2 hover:bg-slate-300 hover:text-slate-900 w-full" type="submit">
                                        <i class="bi bi-box-arrow-left mr-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('login') }}"
                        class="flex items-center hover:text-slate-500 transition{{ request()->segment(1) == 'login' ? ' active' : '' }}">
                        <i class="bi bi-box-arrow-in-right mr-1"></i> Masuk
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
    
    {{-- Mobile navigation --}}
    <div id="mobile-nav" class="fixed bottom-0 w-full z-50 backdrop-blur-lg shadow-md" style="background: #ffffff90">
        <ul class="navbar-nav d-flex flex-row justify-content-center">
            @foreach ($links as $name => $value)
            <li class="nav-item px-3 active:bg-slate-300 transition">
                <a style="color: black" class="text-center nav-link{{ $value['isActive'] ? ' active' : '' }}" href="{{ $value['route'] }}">
                    <span class="{{ $value['isActive'] ? $value['icon'].'-fill' : $value['icon'] }} py-1 px-2 text-xl text-slate-500"></span>
                    <small class="d-block text-xs">{{ $name }}</small>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    
    <script src="/js/navbar.js"></script>
</div>
