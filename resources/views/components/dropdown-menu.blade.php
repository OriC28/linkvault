@props(['id', 'title'])

<div class="absolute right-0 top-8 w-48 bg-white/90 backdrop-blur-xl rounded-xl shadow-lg border border-[#d2d2d7] py-1 z-10">
    <a href="#" class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100">Editar</a>
    <a href="#" class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100">Mover a colección</a>
    <a href="#" class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100">Copiar URL</a>
    <div class="border-t border-gray-100 my-1"></div>
    <a
        class="block px-4 py-2 text-sm text-[#FF3B30] hover:bg-red-50"
        @click="$dispatch(
            'delete-modal',
            {
                actionUrl: '{{ route('bookmarks.destroy', $id) }}',
                title: '¿Eliminar marcador?',
                message: '¿Estás seguro de eliminar «{{ addslashes($title) }}»?'
            }
        )">
        Eliminar
    </a>
</div>
