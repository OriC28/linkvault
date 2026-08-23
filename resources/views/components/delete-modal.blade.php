<div
    x-data="{
        open: false,
        actionUrl: '',
        title: '¿Eliminar elemento?',
        message: '¿Estás seguro de que deseas eliminar este elemento? Esta acción no se puede deshacer.',
        confirmText: 'Eliminar',

        setup(data = {}) {
            this.actionUrl = data.actionUrl || data.action || '';
            this.title = data.title || '¿Eliminar elemento?';
            this.message = data.message || '¿Estás seguro de que deseas eliminar este elemento?';
            this.confirmText = data.confirmText || 'Eliminar';
            this.open = true;
        }
    }"
    @delete-modal.window="setup($event.detail)"
    @keydown.escape.window="open = false"
    x-cloak
>
    <!-- Backdrop & Modal Shell -->
    <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
        <!-- Blurred background -->
        <div
            x-show="open"
            x-transition.opacity
            @click="open = false"
            class="fixed inset-0 bg-black/40 backdrop-blur-sm"
        ></div>

        <!-- Card dialog -->
        <div
            x-show="open"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="relative w-full max-w-sm bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200/70 overflow-hidden text-center p-6"
        >
            <!-- Ícono de Peligro / Alerta -->
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#FF3B30]/10 text-[#FF3B30] mb-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </div>

            <!-- Title and Message -->
            <h3 class="text-base font-semibold text-[#1d1d1f] mb-1.5" x-text="title">
                ¿Eliminar elemento?
            </h3>
            <p class="text-xs text-[#86868b] leading-relaxed mb-6" x-text="message">
                Esta acción no se puede deshacer.
            </p>

            <!-- Form with delete method from Laravel -->
            <form :action="actionUrl" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex items-center justify-center gap-3">
                    <!-- Cancel Button -->
                    <button
                        type="button"
                        @click="open = false"
                        class="w-1/2 bg-white border border-[#d2d2d7] text-[#1d1d1f] text-sm font-medium rounded-xl px-4 py-2 hover:bg-gray-100 transition-all duration-200 cursor-pointer"
                    >
                        Cancelar
                    </button>
                    <!-- Delete Button -->
                    <button
                        type="submit"
                        class="w-1/2 bg-[#FF3B30] text-white text-sm font-medium rounded-xl px-4 py-2 hover:bg-[#CC2F27] transition-all duration-200 shadow-sm cursor-pointer"
                        x-text="confirmText"
                    >
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
