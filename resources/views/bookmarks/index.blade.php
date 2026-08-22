@extends('layouts.app')

@section('content')
    <!-- Top bar -->
    <div class="flex items-center mb-8 gap-3 text-sm">
        <a href="bookmarks-index.html" class="p-2 -ml-2 text-[#86868b] hover:text-[#1d1d1f] hover:bg-gray-100 rounded-lg transition-colors" aria-label="Volver">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <nav class="flex text-[#86868b] font-medium" aria-label="Breadcrumb">
            <a href="#" class="hover:text-[#1d1d1f] transition-colors">Marcadores</a>
            <span class="mx-2">/</span>
            <a href="#" class="hover:text-[#1d1d1f] transition-colors">Desarrollo Web</a>
            <span class="mx-2">/</span>
            <span class="text-[#1d1d1f] truncate max-w-37.5 sm:max-w-xs">Documentación de Laravel 11</span>
        </nav>
    </div>

    <!-- Main Card -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden">
            <!-- Header Section -->
            <div class="p-6 md:p-8 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-start gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-2xl font-bold text-red-600 shrink-0">
                        L
                    </div>
                    <div class="flex-1 min-w-0">
                        <h1 class="text-xl md:text-2xl font-semibold text-[#1d1d1f] mb-2">Documentación de Laravel 11</h1>
                        <a href="https://laravel.com/docs/11.x" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-[#007AFF] hover:underline mb-4 text-sm md:text-base break-all">
                            https://laravel.com/docs/11.x
                            <svg class="w-4 h-4 ml-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>

                        <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-[#86868b]">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                                Desarrollo Web
                            </span>
                            <span class="flex items-center gap-1.5 text-yellow-500">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                Favorito
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                45 visitas
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Guardado hace 3 días
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="p-6 md:p-8 border-b border-gray-100">
                <h2 class="text-sm text-[#86868b] uppercase tracking-wide font-medium mb-3">Descripción</h2>
                <p class="text-base text-[#1d1d1f] leading-relaxed">
                    Documentación oficial del framework Laravel versión 11. Incluye guías de instalación, configuración, y referencia completa de la API.
                </p>
            </div>

            <!-- Tags Section -->
            <div class="p-6 md:p-8 border-b border-gray-100">
                <h2 class="text-sm text-[#86868b] uppercase tracking-wide font-medium mb-3">Etiquetas</h2>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-3 py-1 text-xs font-medium">PHP</span>
                    <span class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-3 py-1 text-xs font-medium">Framework</span>
                    <span class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-3 py-1 text-xs font-medium">Laravel</span>
                    <span class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-3 py-1 text-xs font-medium">Backend</span>
                </div>
            </div>

            <!-- Actions Bar -->
            <div class="bg-gray-50/50 p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="https://laravel.com/docs/11.x" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto inline-flex items-center justify-center bg-[#007AFF] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#0056CC] transition-all duration-200 shadow-sm text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Abrir enlace
                </a>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="bookmark-create.html" class="flex-1 sm:flex-none inline-flex justify-center bg-white border border-[#d2d2d7] text-[#1d1d1f] font-medium rounded-xl px-5 py-2.5 hover:bg-gray-50 transition-all duration-200 text-sm">
                        Editar
                    </a>
                    <button class="flex-1 sm:flex-none inline-flex justify-center bg-white border border-red-200 text-[#FF3B30] font-medium rounded-xl px-5 py-2.5 hover:bg-red-50 hover:border-red-300 transition-all duration-200 text-sm">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>

        <!-- Activity Section -->
        <div class="mt-6 text-center text-xs text-[#86868b] flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-6">
            <span>Último clic: hace 2 horas</span>
            <span class="hidden sm:inline text-gray-300">•</span>
            <span>Creado: 17 de agosto, 2026</span>
            <span class="hidden sm:inline text-gray-300">•</span>
            <span>Modificado: 19 de agosto, 2026</span>
        </div>
    </div>
@endsection
