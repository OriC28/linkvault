@props(['bookmark'])

@php
    extract($bookmark->toArray());
@endphp

<div>
    <a class="block px-4 py-2 text-sm text-[#1d1d1f] hover:bg-gray-100 cursor-pointer"
        @click="$dispatch('bookmark-update-modal', {
            actionUrl: '{{ route('bookmarks.update', $id) }}',
            id: {{ $id }},
            title: {{ json_encode($title) }},
            url: {{ json_encode($bookmark->url) }},
            description: {{ json_encode($description) }},
            collection_id: {{ json_encode($collection_id) }},
            is_favorite: {{ $is_favorite ? 'true' : 'false' }},
            tags:  @js($bookmark->tags->map(fn($tag) => ['id' => $tag->id, 'value' => $tag->name]))
        })">
        Editar
    </a>
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
