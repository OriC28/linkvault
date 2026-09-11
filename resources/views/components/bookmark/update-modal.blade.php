@props([
    'collections' => [],
    'tags' => [],
])

<div x-data="{
    open: {{ $errors->any() || session('warning') ? 'true' : 'false' }},
    actionUrl: '{{ session('edit_bookmark_id') ? url('/bookmarks/' . session('edit_bookmark_id')) : '' }}',
    showWarning: {{ session('warning') ? 'true' : 'false' }},
    form: {
        title: '{{ old('title', '') }}',
        url: '{{ old('url', '') }}',
        description: '{{ old('description', '') }}',
        collection_id: '{{ old('collection_id', '') }}',
        is_favorite: {{ old('is_favorite') ? 'true' : 'false' }},
        tags: '{{ old('tags', '') }}'
    },
    tagifyInstance: null,

    init() {
        if (typeof window.Tagify !== 'undefined' && this.$refs.tagsInput) {
            this.tagifyInstance = new Tagify(this.$refs.tagsInput, {
                whitelist: {{ json_encode($tags) }},
                maxTags: 3,
                dropdown: {
                    maxItems: 5,
                    classname: 'tags-blue',
                    enabled: 0,
                    closeOnSelect: false
                },
            });
        }
    },

    setup(data = {}) {
        this.actionUrl = data.actionUrl || `{{ url('/bookmarks') }}/${data.id || ''}`;
        this.form.title = data.title || '';
        this.form.url = data.url || '';
        this.form.description = data.description || '';
        this.form.collection_id = data.collection_id || '';
        this.form.is_favorite = Boolean(data.is_favorite);
        // Cargar las etiquetas directamente en Tagify
        if (this.tagifyInstance) {
            this.tagifyInstance.removeAllTags();
            if (data.tags && data.tags.length > 0) {
                this.tagifyInstance.addTags(data.tags);
            }
        }
        this.open = true;
    }
}" @bookmark-update-modal.window="setup($event.detail)"
    @keydown.escape.window="open = false; showWarning = false" x-cloak>
    <!-- Backdrop & Modal Shell -->
    <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
        <!-- Fondo desenfocado -->
        <div x-show="open" x-transition.opacity @click="open = false; showWarning = false"
            class="fixed inset-0 bg-black/40 backdrop-blur-sm">
        </div>

        <!-- Tarjeta del Modal -->
        <div x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @click.stop
            class="relative w-full max-w-lg bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200/70 overflow-hidden text-left">
            <form :action="actionUrl" method="POST">
                @csrf
                @method('PUT')

                <!-- Header -->
                <div class="px-6 py-4 border-b border-[#d2d2d7]/60 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[#007AFF]/10 text-[#007AFF] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-[#1d1d1f]">
                            Editar marcador
                        </h3>
                    </div>

                    <button type="button" @click="open = false; showWarning = false"
                        class="text-[#86868b] hover:text-[#1d1d1f] p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body / Form Fields -->
                <div class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
                    <!--  Warning general message  -->
                    <template x-if="showWarning">
                        <div class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 rounded-lg" role="alert">
                            {{ session('warning') }}
                        </div>
                    </template>

                    <!-- URL -->
                    <div>
                        <label for="edit_bookmark_url"
                            class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] mb-1">
                            URL <span class="text-[#FF3B30]">*</span>
                        </label>
                        <input type="url" name="url" id="edit_bookmark_url" x-model="form.url"
                            placeholder="https://ejemplo.com" required
                            class="w-full bg-white/70 rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-sm text-[#1d1d1f] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all">
                        @error('url')
                            <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Título -->
                    <div>
                        <label for="edit_bookmark_title"
                            class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] mb-1">
                            Título <span class="text-[#FF3B30]">*</span>
                        </label>
                        <input type="text" name="title" id="edit_bookmark_title" x-model="form.title"
                            placeholder="Título del marcador" required
                            class="w-full bg-white/70 rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-sm text-[#1d1d1f] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all">
                        @error('title')
                            <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Colección -->
                    <div>
                        <label for="edit_bookmark_collection"
                            class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] mb-1">
                            Colección
                        </label>
                        <select name="collection_id" id="edit_bookmark_collection" x-model="form.collection_id"
                            class="w-full bg-white/70 rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-sm text-[#1d1d1f] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all">
                            <option value="">Sin colección</option>
                            @if ($collections)
                                @foreach ($collections as $coll)
                                    <option value="{{ $coll->id }}"
                                        {{ old('collection_id') == $coll->id ? 'selected' : '' }}>{{ $coll->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('collection_id')
                            <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Etiquetas -->
                    <div>
                        <label for="edit_tags_input"
                            class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] mb-1">
                            Etiquetas
                        </label>
                        <div
                            class="w-full min-h-11.5 bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] px-1.5 flex flex-wrap gap-1.5 items-center focus-within:ring-2 focus-within:ring-[#007AFF]/30 focus-within:border-[#007AFF] transition-all duration-200">
                            <input type="text" name="tags" id="edit_tags_input" x-ref="tagsInput"
                                placeholder="Agregar etiqueta..."
                                class="flex-1 bg-transparent min-w-30 px-2 text-sm placeholder-[#86868b] outline-none">
                        </div>
                        @error('tags')
                            <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label for="edit_bookmark_description"
                            class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] mb-1">
                            Descripción <span class="text-gray-400 font-normal lowercase">(opcional)</span>
                        </label>
                        <textarea name="description" id="edit_bookmark_description" rows="2" x-model="form.description"
                            placeholder="Notas o resumen sobre este enlace..."
                            class="w-full bg-white/70 rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-sm text-[#1d1d1f] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all resize-none"></textarea>
                        @error('description')
                            <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Favorito Checkbox -->
                    <div>
                        <label
                            class="flex items-center gap-3 p-3 bg-gray-50/80 rounded-xl border border-gray-200/60 cursor-pointer select-none">
                            <input type="hidden" name="is_favorite" value="0">
                            <input type="checkbox" name="is_favorite" value="1" x-model="form.is_favorite"
                                class="w-4 h-4 text-[#007AFF] rounded border-[#d2d2d7] focus:ring-[#007AFF] cursor-pointer">
                            <span class="text-xs text-[#1d1d1f] font-medium flex items-center gap-1.5">
                                Marcar como favorito
                            </span>
                        </label>
                        @error('is_favorite')
                            <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Footer Actions -->
                <div class="px-6 py-4 bg-gray-50/90 border-t border-[#d2d2d7]/60 flex justify-end gap-3">
                    <button type="button" @click="open = false; showWarning = false"
                        class="bg-white border border-[#d2d2d7] text-[#1d1d1f] text-sm font-medium rounded-xl px-4 py-2 hover:bg-gray-100 transition-all duration-200 cursor-pointer">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-[#007AFF] text-white text-sm font-medium rounded-xl px-5 py-2 hover:bg-[#0056CC] transition-all duration-200 shadow-sm cursor-pointer">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
