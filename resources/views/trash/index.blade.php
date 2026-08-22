@extends('layouts.app')

@section('content')
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white/80 backdrop-blur-xl border-b border-[#d2d2d7] p-4 flex items-center justify-between sticky top-0 z-30">
      <div class="flex items-center gap-3">
        <svg class="w-6 h-6 text-[#007AFF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
        <span class="text-lg font-semibold">LinkVault</span>
      </div>
      <button onclick="toggleSidebar()" class="p-2 text-[#1d1d1f] bg-gray-100 rounded-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
      </button>
    </header>

    <div class="p-6 lg:p-8 flex-1 max-w-6xl mx-auto w-full">
      <!-- Top bar -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
          <div class="p-2 bg-gray-200/50 rounded-xl text-[#86868b]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
          </div>
          <h1 class="text-2xl font-semibold text-[#1d1d1f]">Papelera</h1>
        </div>
        <button class="bg-[#FF3B30] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#CC2F27] transition-all duration-200 self-start sm:self-auto flex items-center gap-2">
          Vaciar papelera
        </button>
      </div>

      <!-- Info Banner -->
      <div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-xl p-4 flex items-start sm:items-center gap-3 mb-8">
        <span class="text-xl leading-none">⚠️</span>
        <p class="text-sm font-medium">Los elementos en la papelera se eliminan permanentemente después de 30 días</p>
      </div>

      <!-- Trash List -->
      <div class="space-y-3 mb-8">

        <!-- Trashed Item 1 -->
        <div class="bg-white/60 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm opacity-80 hover:opacity-100 transition-opacity flex flex-col sm:flex-row sm:items-center gap-4">
          <div class="flex items-center gap-4 flex-1 min-w-0">
            <div class="p-2.5 bg-gray-100 rounded-lg text-[#86868b] shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-medium text-[#1d1d1f] truncate">Stack Overflow Tips</h3>
              <div class="flex items-center gap-2 text-sm text-[#86868b] mt-1">
                <span class="truncate">Colección: Desarrollo Web</span>
                <span class="w-1 h-1 rounded-full bg-[#d2d2d7]"></span>
                <span class="truncate">Eliminado hace 2 días</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2 self-end sm:self-auto">
            <button class="bg-white border border-[#d2d2d7] text-[#34C759] font-medium rounded-xl px-4 py-2 hover:bg-green-50 transition-all duration-200 text-sm">
              Restaurar
            </button>
            <button class="bg-white border border-[#d2d2d7] text-[#FF3B30] font-medium rounded-xl px-4 py-2 hover:bg-red-50 transition-all duration-200 text-sm">
              Eliminar
            </button>
          </div>
        </div>

        <!-- Trashed Item 2 -->
        <div class="bg-white/60 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm opacity-80 hover:opacity-100 transition-opacity flex flex-col sm:flex-row sm:items-center gap-4">
          <div class="flex items-center gap-4 flex-1 min-w-0">
            <div class="p-2.5 bg-gray-100 rounded-lg text-[#86868b] shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-medium text-[#1d1d1f] truncate">Old API Documentation</h3>
              <div class="flex items-center gap-2 text-sm text-[#86868b] mt-1">
                <span class="italic">Sin colección</span>
                <span class="w-1 h-1 rounded-full bg-[#d2d2d7]"></span>
                <span class="truncate">Eliminado hace 5 días</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2 self-end sm:self-auto">
            <button class="bg-white border border-[#d2d2d7] text-[#34C759] font-medium rounded-xl px-4 py-2 hover:bg-green-50 transition-all duration-200 text-sm">
              Restaurar
            </button>
            <button class="bg-white border border-[#d2d2d7] text-[#FF3B30] font-medium rounded-xl px-4 py-2 hover:bg-red-50 transition-all duration-200 text-sm">
              Eliminar
            </button>
          </div>
        </div>

        <!-- Trashed Item 3 -->
        <div class="bg-white/60 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm opacity-80 hover:opacity-100 transition-opacity flex flex-col sm:flex-row sm:items-center gap-4">
          <div class="flex items-center gap-4 flex-1 min-w-0">
            <div class="p-2.5 bg-blue-50 rounded-lg text-[#007AFF] shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-medium text-[#1d1d1f] truncate">Colección: "Proyectos 2025"</h3>
              <div class="flex items-center gap-2 text-sm text-[#86868b] mt-1">
                <span>3 marcadores</span>
                <span class="w-1 h-1 rounded-full bg-[#d2d2d7]"></span>
                <span class="truncate">Eliminado hace 12 días</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2 self-end sm:self-auto">
            <button class="bg-white border border-[#d2d2d7] text-[#34C759] font-medium rounded-xl px-4 py-2 hover:bg-green-50 transition-all duration-200 text-sm">
              Restaurar
            </button>
            <button class="bg-white border border-[#d2d2d7] text-[#FF3B30] font-medium rounded-xl px-4 py-2 hover:bg-red-50 transition-all duration-200 text-sm">
              Eliminar
            </button>
          </div>
        </div>

        <!-- Trashed Item 4 -->
        <div class="bg-white/60 backdrop-blur-xl rounded-2xl p-4 border border-gray-200/60 shadow-sm opacity-80 hover:opacity-100 transition-opacity flex flex-col sm:flex-row sm:items-center gap-4">
          <div class="flex items-center gap-4 flex-1 min-w-0">
            <div class="p-2.5 bg-gray-100 rounded-lg text-[#86868b] shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            </div>
            <div class="flex-1 min-w-0">
              <h3 class="font-medium text-[#1d1d1f] truncate">Deprecated Library Docs</h3>
              <div class="flex items-center gap-2 text-sm text-[#86868b] mt-1">
                <span class="truncate">Colección: Proyectos 2025</span>
                <span class="w-1 h-1 rounded-full bg-[#d2d2d7]"></span>
                <span class="truncate">Eliminado hace 15 días</span>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-2 self-end sm:self-auto">
            <button class="bg-white border border-[#d2d2d7] text-[#34C759] font-medium rounded-xl px-4 py-2 hover:bg-green-50 transition-all duration-200 text-sm">
              Restaurar
            </button>
            <button class="bg-white border border-[#d2d2d7] text-[#FF3B30] font-medium rounded-xl px-4 py-2 hover:bg-red-50 transition-all duration-200 text-sm">
              Eliminar
            </button>
          </div>
        </div>

      </div>

      <!-- Empty State (Hidden by default, shown when no items) -->
      <!--
      <div class="flex flex-col items-center justify-center py-16 text-center">
        <div class="w-20 h-20 bg-gray-200/50 rounded-full flex items-center justify-center text-[#86868b] mb-6">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
        <h2 class="text-xl font-semibold text-[#1d1d1f] mb-2">La papelera está vacía</h2>
        <p class="text-[#86868b] mb-6">Los marcadores y colecciones eliminados aparecerán aquí</p>
        <button class="bg-white border border-[#d2d2d7] text-[#1d1d1f] font-medium rounded-xl px-5 py-2.5 hover:bg-gray-50 transition-all duration-200">
          Volver al inicio
        </button>
      </div>
      -->

    </div>
@endsection
