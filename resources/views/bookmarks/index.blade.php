@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Marcadores</h1>
        <div class="flex items-center gap-3">
            <div class="relative w-full sm:w-64">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[#86868b]" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" placeholder="Buscar marcadores..."
                    class="w-full bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] pl-9 pr-4 py-2.5 text-sm text-[#1d1d1f] placeholder-[#86868b] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all duration-200">
            </div>
            <button
                class="shrink-0 bg-[#007AFF] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#0056CC] transition-all duration-200 shadow-sm text-sm">
                + Nuevo marcador
            </button>
        </div>
    </div>

    <!-- Filter bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b border-[#d2d2d7] pb-4">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 scrollbar-hide">
            <button
                class="px-4 py-1.5 bg-[#1d1d1f] text-white text-sm font-medium rounded-full whitespace-nowrap">Todos</button>
            <button
                class="px-4 py-1.5 text-[#86868b] hover:bg-gray-100 text-sm font-medium rounded-full whitespace-nowrap transition-colors">Favoritos</button>
            <button
                class="px-4 py-1.5 text-[#86868b] hover:bg-gray-100 text-sm font-medium rounded-full whitespace-nowrap transition-colors">Sin
                colección</button>
        </div>
        <div class="flex items-center gap-4 shrink-0">
            <button class="flex items-center text-sm text-[#1d1d1f] hover:text-[#007AFF] transition-colors cursor-pointer">
                Ordenar por: Más recientes
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="flex items-center bg-white border border-[#d2d2d7] rounded-lg p-0.5">
                <button class="p-1 bg-gray-100 rounded text-[#1d1d1f]" aria-label="Vista de cuadrícula">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                </button>
                <button class="p-1 text-[#86868b] hover:text-[#1d1d1f] rounded transition-colors"
                    aria-label="Vista de lista">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Bookmark grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        @foreach ($bookmarks as $bookmark)
            <!-- Card  -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-5 flex flex-col h-full">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2 overflow-hidden">
                        @if ($bookmark->favicon_url)
                            <img src="{{ $bookmark->favicon_url }}"
                                class="w-6 h-6 rounded-full">
                            </img>
                        @else
                            <div src="{{ $bookmark->favicon_url }}"
                                class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center text-xs font-bold text-red-600 shrink-0">
                                <span>L</span>
                            </div>
                        @endif

                        <span class="text-xs text-[#86868b] truncate">{{ $bookmark->url }}</span>
                    </div>
                    <div class="flex items-center gap-1 shrink-0 relative">
                        <a aria-label="Favorito" @class([
                            'p-1 cursor-pointer',
                            'text-yellow-400' => $bookmark->is_favorite,
                            'text-gray-400/70' => !$bookmark->is_favorite
                        ])>
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </a>
                        <button aria-label="Opciones"
                            class="p-1 text-[#86868b] hover:text-[#1d1d1f] transition-colors rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <h3 class="text-base font-medium text-[#1d1d1f] mb-1 line-clamp-2">{{ $bookmark->title }}</h3>
                <p class="text-xs text-[#86868b] truncate mb-2">{{ $bookmark->url }}</p>
                <p class="text-sm text-[#86868b] line-clamp-2 mb-4 flex-1">{{ $bookmark->description }}</p>
                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-1.5">
                        <span
                            class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[10px] font-medium uppercase tracking-wide">PHP</span>
                        <span
                            class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[10px] font-medium uppercase tracking-wide">Framework</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-[#86868b]">
                        <span class="flex items-center gap-1" title="Visitas"><svg class="w-3.5 h-3.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>{{ $bookmark->click_count }}</span>
                        <span>hace 2h</span>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Card 2 with open dropdown -->
        {{-- <div
            class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-5 flex flex-col h-full relative">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2 overflow-hidden">
                    <div
                        class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-xs font-bold text-blue-500 shrink-0">
                        T</div>
                    <span class="text-xs text-[#86868b] truncate">tailwindcss.com</span>
                </div>
                <div class="flex items-center gap-1 shrink-0 relative">
                    <button aria-label="Favorito" class="p-1 text-[#86868b] hover:text-yellow-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                    </button>
                    <button aria-label="Opciones" class="p-1 text-[#1d1d1f] bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu (Open) -->
                    <div
                        class="absolute right-0 top-8 w-48 bg-white/90 backdrop-blur-xl rounded-xl shadow-lg border border-[#d2d2d7] py-1 z-10">
                        <a href="#" class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100">Editar</a>
                        <a href="#" class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100">Mover a
                            colección</a>
                        <a href="#" class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100">Copiar URL</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="#" class="block px-4 py-2 text-sm text-[#FF3B30] hover:bg-red-50">Eliminar</a>
                    </div>
                </div>
            </div>
            <h3 class="text-base font-medium text-[#1d1d1f] mb-1 line-clamp-2">Guía Completa de Tailwind CSS v4</h3>
            <p class="text-xs text-[#86868b] truncate mb-2">https://tailwindcss.com/docs</p>
            <div class="flex-1"></div> <!-- Spacer for cards without description -->
            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                <div class="flex flex-wrap gap-1.5">
                    <span
                        class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[10px] font-medium uppercase tracking-wide">CSS</span>
                    <span
                        class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[10px] font-medium uppercase tracking-wide">Frontend</span>
                </div>
                <div class="flex items-center gap-3 text-xs text-[#86868b]">
                    <span class="flex items-center gap-1" title="Visitas"><svg class="w-3.5 h-3.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg> 32</span>
                    <span>hace 5h</span>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center gap-1">
        {{ $bookmarks->links() }}
       {{--  <button class="p-2 rounded-lg text-[#86868b] hover:bg-white hover:text-[#1d1d1f] transition-colors"
            disabled>&laquo;</button>
        <button class="w-8 h-8 rounded-lg bg-[#007AFF] text-white font-medium flex items-center justify-center">1</button>
        <button
            class="w-8 h-8 rounded-lg text-[#1d1d1f] hover:bg-white transition-colors font-medium flex items-center justify-center">2</button>
        <button
            class="w-8 h-8 rounded-lg text-[#1d1d1f] hover:bg-white transition-colors font-medium flex items-center justify-center">3</button>
        <span class="px-2 text-[#86868b]">...</span>
        <button
            class="w-8 h-8 rounded-lg text-[#1d1d1f] hover:bg-white transition-colors font-medium flex items-center justify-center">8</button>
        <button class="p-2 rounded-lg text-[#1d1d1f] hover:bg-white transition-colors">&raquo;</button> --}}
    </div>
@endsection
