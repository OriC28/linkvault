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
            <a href="{{ route('bookmarks.create') }}"
                class="shrink-0 bg-[#007AFF] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#0056CC] transition-all duration-200 shadow-sm text-sm cursor-pointer">
                + Nuevo marcador
            </a>
        </div>
    </div>

    <!-- Filter bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b border-[#d2d2d7] pb-4">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 scrollbar-hide">
            <a href="{{ route('bookmarks.index', request()->only('page')) }}"
                class="px-4 py-1.5 text-sm font-medium rounded-full whitespace-nowrap cursor-pointer
                {{ empty(request()->query()) || array_keys(request()->query()) === ['page']
                    ? 'bg-[#1d1d1f] text-white'
                    : 'text-[#86868b] hover:bg-gray-100' }}">
                Sin filtros
            </a>
            <x-filter-button param="is_favorite" value="1">
                Favoritos
            </x-filter-button>
            <x-filter-button param="without_collection" value="1">
                Sin colección
            </x-filter-button>
        </div>
        <div class="flex items-center shrink-0">
            <div x-data="{
                selected: '{{ request('asc') ? 'asc' : (request('desc') ? 'desc' : 'none') }}',
                urls: {
                    none: '{{ route('bookmarks.index') }}',
                    desc: '{{ request()->fullUrlWithQuery(['desc' => '1', 'asc' => null]) }}',
                    asc: '{{ request()->fullUrlWithQuery(['asc' => '1', 'desc' => null]) }}'
                }
            }">
                <select x-model="selected" @change="window.location.href = urls[selected]"
                    class="flex items-center text-sm text-[#1d1d1f] hover:text-[#007AFF] transition-colors cursor-pointer px-4 py-2 hover:bg-gray-100 outline-0">
                    <option value="none">Ordenar por: Ninguno</option>
                    <option value="desc">Ordenar por: Más recientes</option>
                    <option value="asc">Ordenar por: Más antiguos</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Bookmark grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8 auto-rows-fr">
        <!-- Cards  -->
        @forelse ($bookmarks as $bookmark)
            <x-bookmark.card :bookmark="$bookmark" />
        @empty
            <div class="grid col-start-2 col-end-2">
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="w-20 h-20 bg-gray-200/50 rounded-full flex items-center justify-center text-[#86868b] mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M11 2C7.229 2 5.343 2 4.172 3.129C3 4.257 3 6.074 3 9.708v8.273c0 2.306 0 3.459.773 3.871c1.496.8 4.304-1.867 5.637-2.67c.773-.465 1.16-.698 1.59-.698s.817.233 1.59.698c1.333.803 4.14 3.47 5.637 2.67c.773-.412.773-1.565.773-3.871V12m2-10l-7 7m7 0l-7-7" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-[#1d1d1f] mb-2">Sin marcadores</h2>
                    <p class="text-[#86868b] mb-6">No has registrado ningún marcador.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class ="flex justify-center items-center gap-1">
        @if ($bookmarks->hasPages())
            {{ $bookmarks->links() }}
        @endif
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
    <x-shared.delete-modal />
    <x-bookmark.update-modal :collections="$collections" :tags="$tags" />
    <x-bookmark.move-to-collection-modal :collections="$collections" />
@endsection
