@props([
    'name',
    'description',
    'bookmarksCount',
    'isPublic',
    'colors' => [
        'red',
        'purple',
        'yellow',
        'pink',
        'green',
        'blue',
        'orange',
        'gray',
    ]
])
@php
    $color = \Illuminate\Support\Arr::random($colors)
@endphp

<div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-6 flex flex-col h-full group">
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center gap-3">
            <div {{ $attributes->merge(['class' => "w-10 h-10 rounded-xl bg-{$color}-100 text-{$color}-600 flex items-center justify-center"]) }}>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
            </div>
            <a class="font-semibold text-[#1d1d1f] text-xl" href="#">{{ $name }}</a>
        </div>
        <button class="text-[#86868b] hover:text-[#1d1d1f] p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
        </button>
    </div>
    <p class="text-sm text-[#86868b] line-clamp-2 mb-6 flex-1">
        {{ $description }}
    </p>
    <div class="flex items-center justify-between text-xs font-medium text-[#86868b]">
        <span>{{ $bookmarksCount }} marcadores</span>
        <div @class([
            "flex items-center gap-1",
            "text-[#34C759]" => $isPublic
        ])>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            {{ $isPublic ? 'Público' : 'Privado' }}
        </div>
    </div>
</div>
