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
            @forelse ($collections as $coll)
                <x-collection.card :name="$coll['name']" :description="$coll['description']" :bookmarks-count="$coll['bookmarks_count']" :is-public="$coll->is_public_text"
                    :slug="$coll['slug']" />
            @empty
                <div class="grid col-start-2 col-end-2">
                    <div class="flex flex-col items-center justify-center py-16 text-center">
                        <div
                            class="w-20 h-20 bg-gray-200/50 rounded-full flex items-center justify-center text-[#86868b] mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor"
                                    d="m11.066 8.004l.184-.005h7.5a3.25 3.25 0 0 1 3.245 3.065l.005.185v7.5a3.25 3.25 0 0 1-3.066 3.245l-.184.005h-7.5a3.25 3.25 0 0 1-3.245-3.066L8 18.75v-7.5a3.25 3.25 0 0 1 3.066-3.245M18.75 9.5h-7.5a1.75 1.75 0 0 0-1.744 1.606l-.006.144v7.5a1.75 1.75 0 0 0 1.607 1.744l.143.006h7.5a1.75 1.75 0 0 0 1.744-1.607l.006-.143v-7.5a1.75 1.75 0 0 0-1.75-1.75m-3.168-5.266l.052.177l.693 2.588h-1.553l-.588-2.2a1.75 1.75 0 0 0-2.144-1.238L4.798 5.502a1.75 1.75 0 0 0-1.27 1.995l.032.148l1.942 7.244A1.75 1.75 0 0 0 7 16.176v1.506a3.25 3.25 0 0 1-2.895-2.228l-.052-.176l-1.941-7.245a3.25 3.25 0 0 1 2.12-3.928l.178-.052l7.244-1.941a3.25 3.25 0 0 1 3.928 2.12" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-[#1d1d1f] mb-2">Sin colecciones</h2>
                        <p class="text-[#86868b] mb-6">No has registrado ninguna colección.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    {{ $collections->links() }}

    <x-collection.create-modal />
@endsection
