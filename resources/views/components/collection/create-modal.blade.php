<div x-data="{
    open: {{ $errors->any() ? 'true' : 'false' }},
    isEdit: false,
    slug: '',
    name: '{{ old('name') }}',
    description: '{{ old('description') }}',
    is_public: {{ old('is_public') ? 'true' : 'false' }},

    setup(coll = null) {
        this.isEdit = Boolean(coll?.slug);
        this.slug = coll?.slug ?? '';
        this.name = coll?.name ?? '';
        this.description = coll?.description ?? '';
        this.is_public = Boolean(coll?.is_public);
        this.open = true;
    }
}" @collection-modal.window="setup($event.detail)" @keydown.escape.window="open = false" x-cloak>
    <!-- Backdrop & Modal Shell -->
    <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
        <!-- Fondo desenfocado -->
        <div x-show="open" x-transition.opacity @click="open = false" class="fixed inset-0 bg-black/40 backdrop-blur-sm">
        </div>

        <!-- Tarjeta del Modal -->
        <div x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @click.stop
            class="relative w-full max-w-md bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200/70 overflow-hidden">
            <form :action="isEdit ? `/collections/${slug}` : '{{ route('collections.store') }}'" method="POST">
                @csrf
                <!-- Si isEdit es false, este input queda deshabilitado y se envía un POST normal -->
                <input type="hidden" name="_method" value="PUT" :disabled="!isEdit">

                <!-- Header -->
                <div class="px-6 py-4 border-b border-[#d2d2d7]/60 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-[#1d1d1f]"
                        x-text="isEdit ? 'Editar colección' : 'Nueva colección'"></h3>
                    <button type="button" @click="open = false"
                        class="text-[#86868b] hover:text-[#1d1d1f] p-1 rounded-lg">
                        ✕
                    </button>
                </div>

                <!-- Body -->
                <div class="p-6 space-y-4">
                    <!-- Nombre -->
                    <div>
                        <label
                            class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] mb-1">Nombre</label>
                        <input type="text" name="name" x-model="name" placeholder="Ej. Desarrollo Web" required
                            class="w-full bg-white/70 rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-sm text-[#1d1d1f] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none">
                        @error('name')
                            <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label
                            class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] mb-1">Descripción</label>
                        <textarea name="description" x-model="description" rows="3" placeholder="Descripción (opcional)"
                            class="w-full bg-white/70 rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-sm text-[#1d1d1f] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none resize-none"></textarea>
                        @error('description')
                            <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Checkbox pública -->
                    <div class="pt-2 flex items-start gap-3 bg-gray-50/80 rounded-xl p-3.5 border border-gray-200/60">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_public" id="is_public" value="1"
                                {{ old('is_public') ? 'checked' : '' }}
                                class="w-4 h-4 text-[#007AFF] border-[#d2d2d7] rounded focus:ring-[#007AFF] cursor-pointer">
                        </div>
                        <div class="text-xs">
                            <label for="is_public" class="font-medium text-[#1d1d1f] cursor-pointer select-none">
                                Hacer pública esta colección
                            </label>
                            <p class="text-[#86868b] mt-0.5">
                                Generará un enlace accesible para cualquier persona sin necesidad de iniciar sesión.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50/90 border-t border-[#d2d2d7]/60 flex justify-end gap-3">
                    <button type="button" @click="open = false"
                        class="bg-white border border-[#d2d2d7] text-[#1d1d1f] text-sm font-medium rounded-xl px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-[#007AFF] text-white text-sm font-medium rounded-xl px-5 py-2 hover:bg-[#0056CC] cursor-pointer"
                        x-text="isEdit ? 'Guardar cambios' : 'Crear colección'">
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
