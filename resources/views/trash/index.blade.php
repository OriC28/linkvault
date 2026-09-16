@extends('layouts.app')

@section('content')
    <!-- Mobile Header -->
    <header
        class="lg:hidden bg-white/80 backdrop-blur-xl border-b border-[#d2d2d7] p-4 flex items-center justify-between sticky top-0 z-30">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                </path>
            </svg>
            <span class="text-lg font-semibold">LinkVault</span>
        </div>
        <button onclick="toggleSidebar()" class="p-2 text-[#1d1d1f] bg-gray-100 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </header>

    <div class="p-6 lg:p-8 flex-1 max-w-6xl mx-auto w-full">
        <!-- Top bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-gray-200/50 rounded-xl text-[#86868b]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </div>
                <h1 class="text-2xl font-semibold text-[#1d1d1f]">Papelera</h1>
            </div>
            <button
                class="bg-[#FF3B30] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#CC2F27] transition-all duration-200 self-start sm:self-auto flex items-center gap-2 cursor-pointer">
                Vaciar papelera
            </button>
        </div>

        <!-- Info Banner -->
        <div
            class="bg-amber-50 border border-amber-200 text-amber-800 rounded-xl p-4 flex items-start sm:items-center gap-3 mb-8">
            <span class="text-xl leading-none">⚠️</span>
            <p class="text-sm font-medium">Los elementos en la papelera se eliminan permanentemente después de 30 días</p>
        </div>

        <!-- Trash List -->
        <div class="space-y-3 mb-8">
            @forelse ($dataPaginated as $item)
                @php
                    $type = strtolower(class_basename($item));
                @endphp
                @if ($item instanceof \App\Models\Bookmark)
                    <div
                        class="bg-blue-50/50 backdrop-blur-xl rounded-2xl p-4 border border-blue-200/80 shadow-sm opacity-80 hover:opacity-100 transition-opacity flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <div class="p-2.5 bg-blue-100/80 rounded-lg text-[#007AFF] shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-medium text-[#1d1d1f] truncate">{{ $item->title }}</h3>
                                <div class="flex items-center gap-2 text-sm text-[#86868b] mt-1">
                                    <span class="truncate">Colección:
                                        {{ $item->collection->name ?? 'Sin Colección' }}</span>
                                    <span class="w-1 h-1 rounded-full bg-[#d2d2d7]"></span>
                                    <span class="truncate">Eliminado {{ $item->deleted_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 self-end sm:self-auto">
                            <form action="{{ route('trash.restore', ['type' => $type, 'combined_item' => $item->id]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <button
                                    class="bg-white
                                border border-[#d2d2d7] text-[#34C759] font-medium rounded-xl px-4 py-2 hover:bg-green-50
                                transition-all duration-200 text-sm cursor-pointer">
                                    Restaurar
                                </button>
                            </form>
                            <form action="{{ route('trash.destroy', ['type' => $type, 'combined_item' => $item->id]) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-white border border-[#d2d2d7] text-[#FF3B30] font-medium rounded-xl px-4 py-2 hover:bg-red-50 transition-all duration-200 text-sm cursor-pointer">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @elseif ($item instanceof \App\Models\Collection)
                    <div
                        class="bg-purple-50/50 backdrop-blur-xl rounded-2xl p-4 border border-purple-200/80 shadow-sm opacity-80 hover:opacity-100 transition-opacity flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <div class="p-2.5 bg-purple-100/80 rounded-lg text-purple-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-medium text-[#1d1d1f] truncate">Colección: "{{ $item->name }}"</h3>
                                <div class="flex items-center gap-2 text-sm text-[#86868b] mt-1">
                                    <span>{{ $item->bookmarks_count }} marcadores</span>
                                    <span class="w-1 h-1 rounded-full bg-[#d2d2d7]"></span>
                                    <span class="truncate">Eliminado {{ $item->deleted_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 self-end sm:self-auto">
                            <form action="{{ route('trash.restore', ['type' => $type, 'combined_item' => $item->id]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <button
                                    class="bg-white
                                    border border-[#d2d2d7] text-[#34C759] font-medium rounded-xl px-4 py-2
                                    hover:bg-green-50 transition-all duration-200 text-sm cursor-pointer">
                                    Restaurar
                                </button>
                            </form>
                            <form action="{{ route('trash.destroy', ['type' => $type, 'combined_item' => $item->id]) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-white border border-[#d2d2d7] text-[#FF3B30] font-medium rounded-xl px-4 py-2 hover:bg-red-50 transition-all duration-200 text-sm cursor-pointer">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @empty
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="w-20 h-20 bg-gray-200/50 rounded-full flex items-center justify-center text-[#86868b] mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-[#1d1d1f] mb-2">La papelera está vacía</h2>
                    <p class="text-[#86868b] mb-6">Los marcadores y colecciones eliminados aparecerán aquí</p>
                    <a href="{{ route('dashboard') }}"
                        class="bg-white border border-[#d2d2d7] text-[#1d1d1f] font-medium rounded-xl px-5 py-2.5 hover:bg-gray-50 transition-all duration-200">
                        Volver al inicio
                    </a>
                </div>
            @endforelse
        </div>
        {{ $dataPaginated->links() }}
    </div>
@endsection
