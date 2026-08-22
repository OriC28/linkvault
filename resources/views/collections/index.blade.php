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

    <div class="p-6 lg:p-8 flex-1">
      <!-- Top bar -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <h1 class="text-2xl font-semibold text-[#1d1d1f]">Colecciones</h1>
        <button onclick="toggleModal()" class="bg-[#007AFF] text-white font-medium rounded-xl px-5 py-2.5 hover:bg-[#0056CC] transition-all duration-200 shadow-sm flex items-center gap-2 self-start sm:self-auto">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
          Nueva colección
        </button>
      </div>

      <!-- Collections Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        <!-- Card 1 -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-6 flex flex-col h-full group">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
              </div>
              <h3 class="font-semibold text-[#1d1d1f]">Desarrollo Web</h3>
            </div>
            <button class="text-[#86868b] hover:text-[#1d1d1f] p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
          </div>
          <p class="text-sm text-[#86868b] line-clamp-2 mb-6 flex-1">Recursos y documentación para desarrollo web moderno</p>
          <div class="flex items-center justify-between text-xs font-medium text-[#86868b]">
            <span>45 marcadores</span>
            <div class="flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
              Privada
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-6 flex flex-col h-full group">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
              </div>
              <h3 class="font-semibold text-[#1d1d1f]">DevOps</h3>
            </div>
            <button class="text-[#86868b] hover:text-[#1d1d1f] p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
          </div>
          <p class="text-sm text-[#86868b] line-clamp-2 mb-6 flex-1">Docker, CI/CD, infraestructura y despliegue</p>
          <div class="flex items-center justify-between text-xs font-medium text-[#86868b]">
            <span>23 marcadores</span>
            <div class="flex items-center gap-1 text-[#34C759]">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
              Pública
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-6 flex flex-col h-full group">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
              </div>
              <h3 class="font-semibold text-[#1d1d1f]">Diseño UI/UX</h3>
            </div>
            <button class="text-[#86868b] hover:text-[#1d1d1f] p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
          </div>
          <p class="text-sm text-[#86868b] line-clamp-2 mb-6 flex-1">Inspiración, herramientas y guías de diseño</p>
          <div class="flex items-center justify-between text-xs font-medium text-[#86868b]">
            <span>18 marcadores</span>
            <div class="flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
              Privada
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-6 flex flex-col h-full group">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
              </div>
              <h3 class="font-semibold text-[#1d1d1f]">Tutoriales</h3>
            </div>
            <button class="text-[#86868b] hover:text-[#1d1d1f] p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
          </div>
          <p class="text-sm text-[#86868b] line-clamp-2 mb-6 flex-1">Cursos y tutoriales paso a paso</p>
          <div class="flex items-center justify-between text-xs font-medium text-[#86868b]">
            <span>31 marcadores</span>
            <div class="flex items-center gap-1 text-[#34C759]">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
              Pública
            </div>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-6 flex flex-col h-full group">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
              </div>
              <h3 class="font-semibold text-[#1d1d1f]">Machine Learning</h3>
            </div>
            <button class="text-[#86868b] hover:text-[#1d1d1f] p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
          </div>
          <p class="text-sm text-[#86868b] line-clamp-2 mb-6 flex-1">Papers, cursos y herramientas de ML</p>
          <div class="flex items-center justify-between text-xs font-medium text-[#86868b]">
            <span>12 marcadores</span>
            <div class="flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
              Privada
            </div>
          </div>
        </div>

        <!-- Card 6 -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-gray-200/60 hover:shadow-md transition-all duration-300 p-6 flex flex-col h-full group">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-yellow-100 text-yellow-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
              </div>
              <h3 class="font-semibold text-[#1d1d1f]">Lecturas Pendientes</h3>
            </div>
            <button class="text-[#86868b] hover:text-[#1d1d1f] p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
          </div>
          <p class="text-sm text-[#86868b] line-clamp-2 mb-6 flex-1">Artículos por leer cuando tenga tiempo</p>
          <div class="flex items-center justify-between text-xs font-medium text-[#86868b]">
            <span>8 marcadores</span>
            <div class="flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
              Privada
            </div>
          </div>
        </div>

      </div>
    </div>
@endsection
