@extends('layouts.app')

@section('content')
    <header class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold text-[#1d1d1f] tracking-tight">Buenos días,
                {{ auth()->user()->present()->fullName() }}</h1>
            <p class="text-sm text-[#86868b] mt-1 flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Último acceso: {{ auth()->user()->last_login_at->diffForHumans() }}
            </p>
        </div>
    </header>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-10">
        <!-- Stat 1 -->
        <x-dashboard.stat-card title="Total Marcadores" :quantity="$total_bookmarks" color="text-blue-500 bg-blue-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
            </svg>
        </x-dashboard.stat-card>
        <!-- Stat 2 -->
        <x-dashboard.stat-card title="Colecciones" :quantity="$total_collections" color="text-purple-500 bg-purple-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
        </x-dashboard.stat-card>
        <!-- Stat 3 -->
        <x-dashboard.stat-card title="Marcadores favoritos" :quantity="$total_favorites" color="text-yellow-500 bg-yellow-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
            </svg>
        </x-dashboard.stat-card>
        <!-- Stat 4 -->
        <x-dashboard.stat-card title="Esta semana" :quantity="$this_week" color="text-green-500 bg-green-500/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
            </svg>
        </x-dashboard.stat-card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Recent Bookmarks -->
        <div class="lg:col-span-2">
            @if ($recent_bookmarks->isNotEmpty())
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-[#1d1d1f]">Agregados recientemente</h2>
                    <a href="{{ route('bookmarks.index') }}" class="text-sm text-[#007AFF] hover:underline font-medium">Ver
                        todos &rarr;</a>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse ($recent_bookmarks as $bookmark)
                    <div x-data="{ isFavorite: {{ $bookmark->is_favorite ? 'true' : 'false' }} }"
                        class="bg-white/80 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full group relative">
                        <div :class="isFavorite ? 'text-yellow-400' : 'text-gray-400/70'" class="absolute top-4 right-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex items-start gap-3 mb-3">
                            @if ($bookmark->favicon_url)
                                <img src="{{ $bookmark->favicon_url }}"
                                    class="w-6 h-6 rounded-full object-cover object-center">
                                </img>
                            @else
                                <div
                                    class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center text-xs font-bold text-red-600 shrink-0">
                                    <span>{{ $bookmark->present()->initialsURLName() }}</span>
                                </div>
                            @endif
                            <div class="w-64 flex-1 pr-6">
                                <h3
                                    class="font-medium text-[#1d1d1f] line-clamp-1 group-hover:text-[#007AFF] transition-colors">
                                    <a href="{{ route('bookmarks.go', $bookmark->id) }}" target="_blank"
                                        class="focus:outline-none before:absolute before:inset-0">{{ $bookmark->title }}</a>
                                </h3>
                                <p class="text-sm text-[#86868b] truncate mt-0.5">{{ $bookmark->url }}</p>
                            </div>
                        </div>
                        <div class="mt-auto pt-3 flex items-center justify-between">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach ($bookmark->tags as $tag)
                                    <span
                                        class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[11px] font-medium uppercase">{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <span class="text-xs text-[#86868b]">{{ $bookmark->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2">
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <div
                                class="w-20 h-20 bg-gray-200/50 rounded-full flex items-center justify-center text-[#86868b] mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="1.5"
                                        d="M11 2C7.229 2 5.343 2 4.172 3.129C3 4.257 3 6.074 3 9.708v8.273c0 2.306 0 3.459.773 3.871c1.496.8 4.304-1.867 5.637-2.67c.773-.465 1.16-.698 1.59-.698s.817.233 1.59.698c1.333.803 4.14 3.47 5.637 2.67c.773-.412.773-1.565.773-3.871V12m2-10l-7 7m7 0l-7-7" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-[#1d1d1f] mb-2">Sin marcadores</h2>
                            <p class="text-[#86868b] mb-6">No has registrado ningún marcador.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Quick Actions & Tags -->
        <div class="space-y-8">
            <!-- Quick Actions -->
            <div>
                <h2 class="text-lg font-semibold text-[#1d1d1f] mb-4">Acciones rápidas</h2>
                <div class="grid grid-cols-3 gap-3">
                    <a href="{{ route('bookmarks.create') }}"
                        class="bg-white/80 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm hover:shadow-md hover:border-[#007AFF]/30 transition-all duration-300 flex flex-col items-center justify-center gap-2 group">
                        <div
                            class="w-10 h-10 rounded-full bg-[#007AFF]/10 text-[#007AFF] flex items-center justify-center group-hover:bg-[#007AFF] group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-[#1d1d1f] text-center leading-tight">Nuevo<br>marcador</span>
                    </a>

                    <a href="{{ route('collections.index') }}"
                        class="bg-white/80 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm hover:shadow-md hover:border-[#007AFF]/30 transition-all duration-300 flex flex-col items-center justify-center gap-2 group">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-100 text-[#1d1d1f] flex items-center justify-center group-hover:bg-[#007AFF] group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                        </div>
                        <span
                            class="text-xs font-medium text-[#1d1d1f] text-center leading-tight">Nueva<br>colección</span>
                    </a>

                    <button
                        class="bg-white/40 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/40 opacity-70 cursor-not-allowed flex flex-col items-center justify-center gap-2 relative">
                        <span
                            class="absolute -top-2 bg-[#FF9500] text-white text-[9px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">Pronto</span>
                        <div class="w-10 h-10 rounded-full bg-gray-100 text-[#86868b] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-[#86868b] text-center leading-tight">Importar</span>
                    </button>
                </div>
            </div>

            <!-- Tag Cloud -->
            <div>
                <h2 class="text-lg font-semibold text-[#1d1d1f] mb-4">Tus etiquetas</h2>
                <div
                    class="bg-white/80 backdrop-blur-xl rounded-2xl p-5 border border-gray-200/60 shadow-sm flex flex-wrap gap-2 items-center justify-center">
                    @forelse ($tags as $tag)
                        <span
                            class="text-base text-[#007AFF] font-medium hover:underline bg-[#007AFF]/5 rounded-full px-3 py-1">{{ $tag->name }}</span>
                    @empty
                        <p class="text-[#86868b] p-4">No tienes ninguna etiqueta registrada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
