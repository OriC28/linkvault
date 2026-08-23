@props([
    'name',
    'description',
    'bookmarksCount',
    'isPublic',
    'slug'
])
@php
    $colorOptions = [
        'red'    => 'bg-red-100 text-red-600',
        'purple' => 'bg-purple-100 text-purple-600',
        'yellow' => 'bg-yellow-100 text-yellow-600',
        'pink'   => 'bg-pink-100 text-pink-600',
        'green'  => 'bg-green-100 text-green-600',
        'blue'   => 'bg-blue-100 text-blue-600',
        'orange' => 'bg-orange-100 text-orange-600',
        'gray'   => 'bg-gray-100 text-gray-600',
    ];

    $themeClasses = \Illuminate\Support\Arr::random($colorOptions);
@endphp

<div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-6 flex flex-col h-full group">
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center gap-3">
            <div {{
                $attributes->merge(
                    ['class' => "w-10 h-10 rounded-xl flex items-center justify-center { $themeClasses }"]
                )
            }}>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
            </div>
            <a href="{{ route('collections.show', ['collection' => $slug]) }}" class="font-semibold text-[#1d1d1f] text-xl" href="#">{{ $name }}</a>
        </div>
    </div>
    <p class="text-sm text-[#86868b] line-clamp-2 mb-6 flex-1">
        {{ $description }}
    </p>
    <div class="flex items-center justify-between text-xs font-medium text-[#86868b]">
        <span>{{ $bookmarksCount }} marcadores</span>
        <div @class([
            "flex items-center gap-1",
            "text-[#34C759]" => $isPublic === 'Público'
        ])>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            {{ $isPublic }}
        </div>
    </div>
</div>
