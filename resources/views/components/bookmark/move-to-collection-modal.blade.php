@props([
    'collections' => [],
])

<div x-data="{
    open: {{ $errors->hasBag('movingBookmarkForm') ? 'true' : 'false' }},
    hasError: {{ $errors->hasBag('movingBookmarkForm') ? 'true' : 'false' }},
    actionUrl: '',
    bookmarkTitle: '',
    currentCollectionId: null,
    selectedCollectionId: null,

    init() {
        this.$watch('open', value => {
            if (!value) this.hasError = false;
        });
    },

    setup(data = {}) {
        this.actionUrl = data.actionUrl || `{{ url('/bookmarks') }}/${data.id || ''}`;
        this.bookmarkTitle = data.title || 'este marcador';
        // Puede ser un ID numérico o null si no tiene colección
        this.currentCollectionId = (data.collection_id !== undefined && data.collection_id !== '') ? String(data.collection_id) : '';
        this.selectedCollectionId = this.currentCollectionId;
        this.open = true;
    }
}" @move-bookmark-modal.window="setup($event.detail)" @keydown.escape.window="open = false"
    x-cloak>
    <!-- Backdrop & Modal Shell -->
    <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
        <!-- Fondo desenfocado -->
        <div x-show="open" x-transition.opacity @click="open = false" class="fixed inset-0 bg-black/40 backdrop-blur-sm">
        </div>
        <!-- Tarjeta del Modal -->
        <div x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @click.stop
            class="relative w-full max-w-md bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200/70 overflow-hidden text-left">
            <form :action="actionUrl" method="POST">
                @csrf
                @method('PATCH')

                <!-- Header -->
                <div class="px-6 py-4 border-b border-[#d2d2d7]/60 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[#007AFF]/10 text-[#007AFF] flex items-center justify-center">
                            <!-- Ícono Mover Carpeta -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 11v6m0 0l-2-2m2 2l2-2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-[#1d1d1f]">
                                Mover a colección
                            </h3>
                            <p class="text-xs text-[#86868b] truncate max-w-[260px]"
                                x-text="`Moviendo: ${bookmarkTitle}`"></p>
                        </div>
                    </div>

                    <button type="button" @click="open = false"
                        class="text-[#86868b] hover:text-[#1d1d1f] p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body / Lista de Colecciones -->
                <div class="p-6">
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#86868b] mb-3">
                        Selecciona el destino:
                    </p>
                    @error('collection_id', 'movingBookmarkForm')
                        <div x-show="hasError" class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 rounded-lg" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="max-h-64 overflow-y-auto space-y-2 pr-1 custom-scrollbar">
                        <!-- Opción: Sin Colección (Raíz) -->
                        <label
                            class="flex items-center justify-between p-3 rounded-xl border cursor-pointer transition-all duration-150"
                            :class="selectedCollectionId === ''
                                ?
                                'border-[#007AFF] bg-[#007AFF]/5 text-[#007AFF] ring-1 ring-[#007AFF]' :
                                'border-[#d2d2d7]/80 hover:bg-gray-50/80 text-[#1d1d1f]'">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="collection_id" value="" x-model="selectedCollectionId"
                                    class="hidden">
                                <div
                                    class="w-7 h-7 rounded-lg bg-gray-100 text-gray-500 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Sin colección</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <template x-if="currentCollectionId === ''">
                                    <span
                                        class="text-[10px] bg-gray-100 text-[#86868b] px-2 py-0.5 rounded-full font-medium">
                                        Actual
                                    </span>
                                </template>
                                <template x-if="selectedCollectionId === ''">
                                    <svg class="w-4 h-4 text-[#007AFF]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </template>
                            </div>
                        </label>

                        <!-- Colecciones del Usuario -->
                        @foreach ($collections as $collection)
                            <label
                                class="flex items-center justify-between p-3 rounded-xl border cursor-pointer transition-all duration-150"
                                :class="selectedCollectionId === '{{ $collection->id }}'
                                    ?
                                    'border-[#007AFF] bg-[#007AFF]/5 text-[#007AFF] ring-1 ring-[#007AFF]' :
                                    'border-[#d2d2d7]/80 hover:bg-gray-50/80 text-[#1d1d1f]'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="collection_id" value="{{ $collection->id }}"
                                        x-model="selectedCollectionId" class="hidden">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-[#007AFF]/10 text-[#007AFF] flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium">{{ $collection->name }}</span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <template x-if="currentCollectionId === '{{ $collection->id }}'">
                                        <span
                                            class="text-[10px] bg-gray-100 text-[#86868b] px-2 py-0.5 rounded-full font-medium">
                                            Actual
                                        </span>
                                    </template>
                                    <template x-if="selectedCollectionId === '{{ $collection->id }}'">
                                        <svg class="w-4 h-4 text-[#007AFF]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </template>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="px-6 py-4 bg-gray-50/90 border-t border-[#d2d2d7]/60 flex justify-end gap-3">
                    <button type="button" @click="open = false"
                        class="bg-white border border-[#d2d2d7] text-[#1d1d1f] text-sm font-medium rounded-xl px-4 py-2 hover:bg-gray-100 transition-all duration-200 cursor-pointer">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-[#007AFF] text-white text-sm font-medium rounded-xl px-5 py-2 hover:bg-[#0056CC] transition-all duration-200 shadow-sm cursor-pointer">
                        Mover marcador
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
