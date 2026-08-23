@props([
    'bookmarkName',
    'isFavorite',
    'tags',
    'clickCount'
])

<div class="bg-white/80 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm hover:shadow-md transition-all duration-300 flex items-center gap-4">
    <!-- Favicon to link -->
    <div class="w-10 h-10 rounded-full bg-red-100 shrink-0 flex items-center justify-center text-red-600 font-bold text-lg">
        L
    </div>
    <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 mb-1">
            <h3 class="font-medium text-[#1d1d1f] truncate">Documentación de Laravel 11</h3>
            <svg class="w-4 h-4 text-yellow-400 fill-current shrink-0" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
        </div>
        <a href="#" class="text-sm text-[#86868b] hover:text-[#007AFF] truncate block mb-2">laravel.com</a>
        <div class="flex items-center gap-2 flex-wrap">
            <span class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[10px] font-medium">PHP</span>
            <span class="inline-flex items-center bg-[#007AFF]/10 text-[#007AFF] rounded-full px-2.5 py-0.5 text-[10px] font-medium">Framework</span>
        </div>
    </div>
    <div class="hidden sm:flex items-center gap-1 text-xs text-[#86868b] bg-gray-100 px-2.5 py-1 rounded-full">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
        45
    </div>
    <button class="text-[#86868b] hover:text-[#1d1d1f] p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
    </button>
</div>
