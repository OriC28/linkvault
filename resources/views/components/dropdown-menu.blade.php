@props(['id', 'title', 'url'])

<div>
    <a href="#" class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100 cursor-pointer">Editar</a>
    <a href="#" class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100 cursor-pointer">Mover a
        colección</a>
    <a @click="copyToClipboard('{{ $url }}'); open = false;"
        class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100 cursor-pointer">
        Copiar URL
    </a>
    <div class="border-t border-gray-100 my-1"></div>
    <a class="block px-4 py-2 text-sm text-[#FF3B30] hover:bg-red-50"
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
