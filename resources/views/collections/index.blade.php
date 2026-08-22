@extends('layouts.app')

@section('content')
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white/80 backdrop-blur-xl border-b border-[#d2d2d7] p-4 flex items-center justify-between sticky top-0 z-30">
      <div class="flex items-center gap-3">
        <svg class="w-6 h-6 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
        <span class="text-lg font-semibold">LinkVault</span>
      </div>
      <button onclick="toggleSidebar()" class="p-2 text-[#1d1d1f] bg-gray-100 rounded-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
      </button>
    </header>

    <div class="p-6 lg:p-8 flex-1">
      <!-- Top bar -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Colecciones</h1>
        <button onclick="toggleModal()" class="bg-[#007AFF] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#0056CC] transition-all duration-200 shadow-sm flex items-center gap-2 self-start sm:self-auto">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
          Nueva colección
        </button>
      </div>

      <!-- Collections Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach ($collections as $coll)
            <x-collection-card
                :name="$coll['name']"
                :description="$coll['description']"
                :bookmarks-count="$coll['bookmarks_count']"
                :is-public="$coll['is_public']"
            >
            </x-collection-card>
        @endforeach
      </div>
    </div>
    {{ $collections->links() }}
@endsection
