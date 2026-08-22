<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <title>{{ config('app.name', 'Laravel') }} - Inicio de Sesión</title>
</head>
<body class="bg-[#f5f5f7] min-h-screen flex items-center justify-center relative overflow-hidden font-sans">
    <!-- Gradient Blobs -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-[#007AFF]/20 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-125 h-125 bg-purple-500/10 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

    <!-- Login Card -->
    <form class="w-full max-w-md mx-4 relative z-10" method="GET" action="{{ route('auth.redirect') }}">
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-lg border border-gray-200/60 p-8 lg:p-10 text-center">
            <!-- Logo -->
            <div class="flex justify-center items-center gap-2 mb-2 text-[#007AFF]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                </svg>
                <h1 class="text-3xl font-bold text-[#1d1d1f] tracking-tight">LinkVault</h1>
            </div>

            <p class="text-[#86868b] text-base mb-10">Tu biblioteca personal de enlaces</p>

            <!-- Google Login Button -->
            <button class="w-full bg-white border border-[#d2d2d7] rounded-xl px-5 py-3 flex items-center justify-center gap-3 hover:bg-gray-50 hover:shadow-md transition-all duration-300 group shadow-sm cursor-pointer">
                <svg viewBox="0 0 24 24" class="w-6 h-6">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <span class="text-[#1d1d1f] font-medium text-base">Continuar con Google</span>
            </button>

            <p class="text-xs text-[#86868b] mt-5">Al continuar, aceptas nuestros <a href="#" class="text-[#007AFF] hover:underline">Términos</a> y <a href="#" class="text-[#007AFF] hover:underline">Política de Privacidad</a></p>

           @if (session('error'))
                <span class="font-semibold text-red-500 text-center">{{session('error')}}</span>
           @endif

            <div class="mt-8 pt-6 border-t border-[#d2d2d7]/50">
                <p class="text-sm text-[#86868b]">¿Primera vez? Se creará tu cuenta automáticamente</p>
            </div>
        </div>
    </form>
</body>
</html>
