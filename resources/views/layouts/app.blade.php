<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/js/app.js'])
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @endif
    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>
</head>

<body class="bg-[#f5f5f7] font-sans text-[#1d1d1f]">

    <!-- Mobile Top Bar -->
    <div
        class="lg:hidden flex items-center justify-between bg-white/80 backdrop-blur-xl border-b border-gray-200/60 p-4 sticky top-0 z-40">
        <div class="flex items-center gap-2 text-[#007AFF]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
            </svg>
            <span class="font-bold text-lg text-[#1d1d1f]">LinkVault</span>
        </div>
        <button id="mobileMenuBtn" aria-label="Abrir menú"
            class="p-2 text-[#1d1d1f] rounded-lg hover:bg-gray-100 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity">
    </div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-screen w-64 bg-white/80 backdrop-blur-xl border-r border-[#d2d2d7] flex flex-col z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <!-- Logo Area -->
        <div class="p-6 flex items-center gap-2 text-[#007AFF]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
            </svg>
            <span class="text-xl font-bold text-[#1d1d1f] tracking-tight">LinkVault</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto" id="navContainer">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 hover:text-[#1d1d1f] font-medium transition-colors {{ request()->routeIs('dashboard') ? 'active' : 'text-[#86868b]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('bookmarks.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#86868b] hover:bg-gray-100 hover:text-[#1d1d1f] font-medium transition-colors {{ request()->routeIs('bookmarks.*') || (request()->routeIs('search') && request('type') === 'bookmarks') ? 'active' : 'text-[#86868b]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                </svg>
                Marcadores
            </a>
            <a href="{{ route('collections.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#86868b] hover:bg-gray-100 hover:text-[#1d1d1f] font-medium transition-colors {{ request()->routeIs('collections.*') || (request()->routeIs('search') && request('type') === 'collection') ? 'active' : 'text-[#86868b]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                Colecciones
            </a>
            <a href="{{ route('trash.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#86868b] hover:bg-gray-100 hover:text-[#1d1d1f] font-medium transition-colors {{ request()->routeIs('trash.*') ? 'active' : 'text-[#86868b]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                Papelera
            </a>
        </nav>

        <!-- User Profile Area -->
        <div class="p-4 border-t border-[#d2d2d7]">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 overflow-hidden">
                    @if (auth()->user()->avatar_url)
                        <img src="{{ auth()->user()->avatar_url }}" referrerpolicy="no-referrer" alt="Foto de perfil"
                            class="w-9 h-9 rounded-full bg-[#007AFF] text-white flex items-center justify-center font-semibold text-sm shrink-0">
                        </img>
                    @else
                        <div
                            class="w-9 h-9 rounded-full bg-[#007AFF] text-white flex items-center justify-center font-semibold text-sm shrink-0">
                            {{ auth()->user()->present()->initialsName() }}
                        </div>
                    @endif
                    <div class="flex flex-col overflow-hidden">
                        <span class="text-sm font-medium text-[#1d1d1f] truncate">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-[#86868b] truncate">{{ auth()->user()->email }}</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Cerrar sesión"
                        class="p-2 text-[#86868b] hover:text-[#FF3B30] hover:bg-red-50 rounded-lg transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 p-6 lg:p-8 min-h-screen">
        @yield('content')
    </main>

    <script>
        // Mobile Sidebar Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');
        const navContainer = document.getElementById('navContainer');

        function toggleMenu(e) {
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                mobileOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                mobileOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        mobileMenuBtn.addEventListener('click', toggleMenu);
        mobileOverlay.addEventListener('click', toggleMenu);
    </script>

    @if (session('error') || session('warning') || session('success') || session()->has('collections_trashed'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('error'))
                    new window.Notify({
                        status: 'error',
                        title: 'Error',
                        text: '{{ session('error') }}',
                        autoclose: true,
                        autotimeout: 4000
                    });
                @endif

                @if (session('warning'))
                    new window.Notify({
                        status: 'warning',
                        title: 'Sin cambios realizados',
                        text: '{{ session('warning') }}',
                        autoclose: true,
                        autotimeout: 4000
                    });
                @endif

                @if (session()->has('collections_trashed'))
                    new window.Notify({
                        status: 'success',
                        title: 'Papelera vaciada',
                        text: 'Se eliminaron definitivamente {{ session('bookmarks_trashed') }} marcadores y {{ session('collections_trashed') }} colecciones.',
                        autoclose: true,
                        autotimeout: 4000
                    });
                @endif

                @if (session('success'))
                    new window.Notify({
                        status: 'success',
                        title: 'Éxito',
                        text: '{{ session('success') }}',
                        autoclose: true,
                        autotimeout: 3000
                    });
                @endif
            });
        </script>
    @endif
</body>

</html>
