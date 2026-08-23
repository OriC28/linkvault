@props([
    'placeholder',
])

<div class="relative flex-1">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="w-5 h-5 text-[#86868b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </div>
    <input type="text" placeholder="{{ $placeholder }}" class="w-full bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] pl-10 pr-4 py-2.5 text-[#1d1d1f] placeholder-[#86868b] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all duration-200">
</div>
