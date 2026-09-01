<a  href="{{ $url }}"
    class="px-4 py-1.5 text-sm font-medium rounded-full whitespace-nowrap cursor-pointer {{ $isActive ? 'bg-[#1d1d1f] text-white' : 'text-[#86868b] hover:bg-gray-100'}}">
    {{ $slot }}
</a>

