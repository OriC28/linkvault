@props(['bookmark'])

<div x-data="{ open: false }" :key="{{ $bookmark->id }}"
    class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-5 flex flex-col h-full">
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center gap-2 overflow-hidden">
            @if ($bookmark->favicon_url)
                <img src="{{ $bookmark->favicon_url }}" class="w-6 h-6 rounded-full">
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
                'text-gray-400/70' => !$bookmark->is_favorite,
            ])>
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                    </path>
                </svg>
            </a>
            <!-- Options Button -->
            <button @click="open = !open" aria-label="Opciones"
                class="p-1 text-[#86868b] hover:text-[#1d1d1f] transition-colors rounded-lg hover:bg-gray-100 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                    </path>
                </svg>
            </button>
            <!-- Dropdown Options -->
            <div x-show="open" x-cloak @click.away="open = false">
                <x-dropdown-menu :id="$bookmark->id" :title="$bookmark->title" :url="$bookmark->url" />
            </div>
        </div>
    </div>
    <h3 class="text-base font-medium text-[#1d1d1f] mb-1 line-clamp-2">{{ $bookmark->title }}</h3>
    <p class="text-xs text-[#86868b] truncate mb-2">{{ $bookmark->url }}</p>
    <p class="text-sm text-[#86868b] line-clamp-2 mb-4 flex-1">{{ $bookmark->description }}</p>
    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
        <!-- Tags -->
        <div class="flex flex-wrap gap-1.5">
            @foreach ($bookmark->tags as $tag)
                <span
                    class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[10px] font-medium uppercase tracking-wide">
                    {{ $tag->name }}
                </span>
            @endforeach
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
            @if ($bookmark->last_clicked_at)
                <span>{{ $bookmark->last_clicked_at->diffForHumans() }}</span>
            @else
                <span>Aún sin visitar</span>
            @endif
        </div>
    </div>
</div>
