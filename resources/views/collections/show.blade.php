@extends('layouts.app')

@section('content')
    <div x-data class="p-6 lg:p-8 flex-1 max-w-6xl mx-auto w-full">
        <!-- Top bar -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('collections.index') }}"
                class="p-2 text-[#86868b] hover:text-[#1d1d1f] hover:bg-gray-200/50 rounded-xl transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <h1 class="text-2xl font-semibold text-[#1d1d1f]">{{ $collection->name }}</h1>
            <div @class([
                'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-200/50 text-xs font-medium',
                'text-[#34C759]' => $collection->is_public,
                'text-[#86868b]' => !$collection->is_public,
            ])>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                {{ $collection->is_public_text }}
            </div>
        </div>

        <!-- Collection Info Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl p-6 border border-gray-200/60 mb-8 shadow-sm">
            @empty($collection->description)
                <p class="text-[#86868b] mb-4">No hay una descripción para esta colección.</p>
            @endempty
            <p class="text-[#86868b] mb-4">{{ $collection->description }}</p>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4 text-sm text-[#86868b]">
                    <span>{{ $collection->bookmarks_count }} marcadores</span>
                    <span class="w-1 h-1 rounded-full bg-[#d2d2d7]"></span>
                    <span>Creada: {{ $collection->created_at->translatedFormat('l j \d\e F \d\e Y') }} </span>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Edit Button -->
                    <button @click="$dispatch('collection-modal', {{ json_encode($collection) }})"
                        class="bg-white border border-[#d2d2d7] text-[#1d1d1f] font-medium rounded-xl px-4 py-2 hover:bg-gray-50 transition-all duration-200 text-sm cursor-pointer">
                        Editar colección
                    </button>
                    <!-- Delete Button -->
                    <button
                        @click="$dispatch(
                        'delete-modal',
                        {
                            actionUrl: '{{ route('collections.destroy', $collection->slug) }}',
                            title: '¿Eliminar colección?',
                            message: '¿Estás seguro de eliminar «{{ addslashes($collection->name) }}»? Los marcadores no se borrarán, pero quedarán sin colección asignada.'
                        }
                    )"
                        class="text-[#FF3B30] hover:bg-[#FF3B30]/10 font-medium rounded-xl px-4 py-2 transition-all duration-200 text-sm cursor-pointer">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <x-search-bar placeholder="Buscar en esta colección..." />
            <select
                class="bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-[#1d1d1f] outline-none focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF]">
                <option>Más recientes</option>
                <option>Más antiguos</option>
                <option>A-Z</option>
                <option>Z-A</option>
            </select>
        </div>

        <!-- Bookmarks List -->
        <div class="space-y-3 mb-8">
            @forelse ($bookmarks as $bookmark)
                <div
                    class ="bg-white/80 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm
                    hover:shadow-md transition-all duration-300 flex items-center gap-4">
                    @if ($bookmark->favicon_url)
                        <img src="{{ $bookmark->favicon_url ?? '' }}"
                            class="w-10 h-10 rounded-full bg-red-100 shrink-0 flex items-center justify-center text-red-600 font-bold text-lg">
                        </img>
                    @else
                        <div
                            class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center text-xs font-bold text-red-600 shrink-0">
                            <span>{{ $bookmark->present()->initialsURLName() }}</span>
                        </div>
                    @endif
                    <div>
                        <div class="flex items-center gap-2 mb-1" class="flex-1 min-w-0">
                            <h3 class="font-medium text-[#1d1d1f] truncate">{{ $bookmark->title }}</h3>
                            <svg @class([
                                'w-4 h-4 fill-current shrink-0',
                                'text-yellow-400' => $bookmark->is_favorite,
                                'text-gray-400/70' => !$bookmark->is_favorite,
                            ]) viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </div>

                        <a href="{{ $bookmark->url }}" target="_blank"
                            class="text-sm text-[#86868b] hover:text-[#007AFF] truncate block mb-2">{{ $bookmark->url }}</a>
                        <div class="flex items-center gap-2 flex-wrap">
                            @foreach ($bookmark->tags as $tag)
                                <span
                                    class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[10px] font-medium uppercase tracking-wide">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div
                        class="hidden sm:flex items-center gap-1 text-xs text-[#86868b] bg-gray-100 px-2.5 py-1 rounded-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        {{ $bookmark->click_count }}
                    </div>
                    <button
                        class="text-[#86868b] hover:text-[#1d1d1f] p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                            </path>
                        </svg>
                    </button>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="w-20 h-20 bg-gray-200/50 rounded-full flex items-center justify-center text-[#86868b] mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path fill="currentColor"
                                d="M18.975 7.425q.775.6.775 1.575t-.775 1.575L16.8 12.25q-.3.225-.675.2t-.65-.3q-.325-.325-.288-.763t.388-.712L17.75 9 12 4.55 10.35 5.8q-.3.225-.675.2t-.65-.3q-.325-.325-.288-.763t.388-.712l1.65-1.275q.55-.425 1.225-.425t1.225.425zM19.1 21.4l-3.3-3.3-2.575 2q-.55.425-1.225.425t-1.225-.425l-6.75-5.25q-.4-.3-.387-.787t.412-.788q.275-.2.6-.2t.6.2L12 18.5l2.35-1.825-1.75-1.7h.725l-.1.05q-.55.425-1.225.438t-1.225-.413l-5.75-4.475Q4.25 9.975 4.25 9t.775-1.575l.05-.05L2.1 4.425q-.3-.3-.312-.712T2.075 3t.713-.3.712.3l17 17q.275.275.275.7t-.275.7-.7.275-.7-.275m.875-8.125q.375.3.375.775t-.375.8l-.3.25q-.3.25-.675.225t-.65-.3q-.325-.325-.3-.788t.4-.737l.3-.225q.275-.2.613-.2t.612.2" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-[#1d1d1f] mb-2">La colección está vacía</h2>
                    <p class="text-[#86868b] mb-6">Esta colección no tiene ningún marcador. Agrega uno y vuelve.</p>
                    <a href="{{ route('bookmarks.index') }}"
                        class="bg-white border border-[#d2d2d7] text-[#1d1d1f] font-medium rounded-xl px-5 py-2.5 hover:bg-gray-50 transition-all duration-200">
                        Ir a marcadores
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        {{ $bookmarks->links() }}
    </div>
    <!-- Modals -->
    <x-collection.create-modal />
    <x-shared.delete-modal />
@endsection
