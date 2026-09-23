@props(['title', 'quantity', 'color'])

<div
    class="bg-white/80 backdrop-blur-xl rounded-2xl p-6 border border-gray-200/60 shadow-sm hover:shadow-md transition-all duration-300">
    <div class="flex items-center justify-between mb-2">
        <h3 class="text-xs text-[#86868b] uppercase tracking-wide font-medium">{{ $title }}</h3>
        <div {{ $attributes->merge(['class' => "w-8 h-8 rounded-full flex items-center justify-center $color"]) }}>
            {{ $slot }}
        </div>
    </div>
    @if ($title === 'Esta semana')
        <p class="text-3xl font-semibold text-[#34C759]">+{{ $quantity }}</p>
    @else
        <p class="text-4xl font-semibold text-[#1d1d1f]">{{ $quantity }}</p>
    @endif
</div>
