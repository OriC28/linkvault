@extends('layouts.app')

@section('content')
    <div x-data class="p-6 lg:p-8 flex-1">
        <!-- Top bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <h1 class="text-2xl font-semibold text-[#1d1d1f]">Colecciones</h1>
            <button @click="$dispatch('collection-modal')"
                class="bg-[#007AFF] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#0056CC] transition-all duration-200 shadow-sm flex items-center gap-2 self-start sm:self-auto cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva colección
            </button>
        </div>

        <!-- Collections Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($collections as $coll)
                @if ($coll)
                    <x-collection.card :name="$coll['name']" :description="$coll['description']" :bookmarks-count="$coll['bookmarks_count']" :is-public="$coll->is_public_text"
                        :slug="$coll['slug']" />
                @endif
            @endforeach
        </div>
    </div>
    {{ $collections->links() }}

    <x-collection.create-modal />
@endsection
