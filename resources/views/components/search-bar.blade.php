@props([
    'placeholder',
    'type' => 'bookmarks',
    'collectionId' => null,
    'collectionSlug' => null,
])

<div x-data="{
    keyword: @js(request('keyword', '')),
    search() {
        if (this.keyword.trim() === '') {
            window.location.href = this.getOriginalRoute();
            return;
        }
        
        let url = new URL('{{ route('search') }}');
        url.searchParams.set('keyword', this.keyword.trim());
        url.searchParams.set('type', '{{ $type }}');
        
        @if($collectionId)
            url.searchParams.set('collection_id', '{{ $collectionId }}');
            url.searchParams.set('collection_slug', '{{ $collectionSlug }}');
        @endif
        
        let currentParams = new URLSearchParams(window.location.search);
        for (let [key, value] of currentParams.entries()) {
            if (!['keyword', 'type', 'collection_id', 'collection_slug', 'page'].includes(key)) {
                url.searchParams.set(key, value);
            }
        }
        
        window.location.href = url.toString();
    },
    getOriginalRoute() {
        @if($type === 'collection' && $collectionSlug)
            return '{{ route('collections.show', $collectionSlug) }}';
        @else
            return '{{ route('bookmarks.index') }}';
        @endif
    }
}" class="relative flex-1">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="w-5 h-5 text-[#86868b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </div>
    <input type="text" 
           x-ref="searchInput"
           x-model="keyword" 
           @input.debounce.500ms="search"
           x-init="
               if (keyword !== '') {
                   $nextTick(() => {
                       $refs.searchInput.focus();
                       $refs.searchInput.setSelectionRange(keyword.length, keyword.length);
                   });
               }
           "
           placeholder="{{ $placeholder }}" 
           class="w-full bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] pl-10 pr-4 py-2.5 text-[#1d1d1f] placeholder-[#86868b] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all duration-200">
</div>
