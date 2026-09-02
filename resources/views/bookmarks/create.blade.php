@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-3">
        <a href="{{ route('bookmarks.index') }}"
            class="p-2 -ml-2 mr-2 text-[#86868b] hover:text-[#1d1d1f] hover:bg-gray-100 rounded-lg transition-colors"
            aria-label="Volver">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Nuevo marcador</h1>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 p-3 md:p-8">
            <form method="POST" action="{{ route('bookmarks.store') }}">
                @csrf
                <!-- URL Field -->
                <div class="mb-3">
                    <label for="url" class="block text-sm font-medium text-[#1d1d1f] mb-1.5">URL <span
                            class="text-red-500">*</span></label>
                    <input type="url" id="url" name="url" placeholder="https://ejemplo.com/articulo"
                        class="w-full bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-[#1d1d1f] placeholder-[#86868b] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all duration-200"
                        value="{{ old('url') }}">
                    <p class="mt-1.5 text-xs text-[#86868b]">Pegaremos el título automáticamente</p>
                    @error('url')
                        <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title Field -->
                <div class="mb-3">
                    <label for="title" class="block text-sm font-medium text-[#1d1d1f] mb-1.5">Título <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" placeholder="Título del marcador"
                        value="{{ old('title') }}"
                        class="w-full bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-[#1d1d1f] placeholder-[#86868b] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all duration-200">
                    @error('title')
                        <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-3">
                    <label for="description" class="block text-sm font-medium text-[#1d1d1f] mb-1.5">Descripción</label>
                    <textarea id="description" name="description" rows="3" placeholder="Agrega una nota o descripción..."
                        class="w-full bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] px-4 py-2.5 text-[#1d1d1f] placeholder-[#86868b] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all duration-200 resize-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Collection Field -->
                <div class="mb-3">
                    <label for="collection" class="block text-sm font-medium text-[#1d1d1f] mb-1.5">Colección</label>
                    <div class="relative">
                        <select id="collection" name="collection_id"
                            class="w-full bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] px-4 py-2.5 pr-10 text-[#1d1d1f] focus:ring-2 focus:ring-[#007AFF]/30 focus:border-[#007AFF] outline-none transition-all duration-200 appearance-none">
                            <option value="">Sin colección</option>
                            @if ($collections)
                                @foreach ($collections as $coll)
                                    <option value="{{ $coll->id }}"
                                        {{ old('collection_id') == $coll->id ? 'selected' : '' }}>{{ $coll->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#86868b]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @error('collection_id')
                        <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags Field -->
                <div class="mb-3">
                    <label for="tags" class="block text-sm font-medium text-[#1d1d1f] mb-1.5">Etiquetas</label>
                    <div
                        class="w-full min-h-11.5 bg-white/60 backdrop-blur rounded-xl border border-[#d2d2d7] px-1.5 flex flex-wrap gap-1.5 items-center focus-within:ring-2 focus-within:ring-[#007AFF]/30 focus-within:border-[#007AFF] transition-all duration-200">
                        <!-- Input -->
                        <input type="text" name="tags" id="tags-input" placeholder="Agregar etiqueta..."
                            value="{{ old('tags') }}" x-init="new Tagify($el, {
                                whitelist: {{ json_encode($tags) }},
                                maxTags: 3,
                                dropdown: {
                                    maxItems: 5,
                                    classname: 'tags-blue',
                                    enabled: 0,
                                    closeOnSelect: false
                                }
                            })"
                            class="flex-1 bg-transparent min-w-30 px-2 text-sm placeholder-[#86868b] outline-none">
                    </div>
                    @error('tags')
                        <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Favorite Toggle -->
                <div class="mb-4 flex items-center">
                    <label for="favorite-toggle" class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input type="hidden" name="is_favorite" value="0">
                            <input type="checkbox" id="favorite-toggle" name="is_favorite" value="1" class="sr-only"
                                @checked(old('is_favorite', false))>
                            <div
                                class="block bg-gray-200 w-11 h-6 rounded-full transition-colors duration-300 peer-checked:bg-[#007AFF]">
                            </div>
                            <div
                                class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-300 peer-checked:translate-x-full">
                            </div>
                        </div>
                        <div class="ml-3 text-sm font-medium text-[#1d1d1f]">Marcar como favorito</div>
                    </label>
                    <style>
                        #favorite-toggle:checked~.block {
                            background-color: #007AFF;
                        }

                        #favorite-toggle:checked~.dot {
                            transform: translateX(1.25rem);
                        }
                    </style>
                    @error('is_favorite')
                        <p class="text-xs text-[#FF3B30] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button"
                        class="bg-white border border-[#d2d2d7] text-[#1d1d1f] font-medium rounded-xl px-5 py-2.5 hover:bg-gray-50 transition-all duration-200 text-sm">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-[#007AFF] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#0056CC] transition-all duration-200 shadow-sm text-sm">
                        Guardar marcador
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
