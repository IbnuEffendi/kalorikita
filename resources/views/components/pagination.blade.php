@if ($paginator->hasPages())
    {{-- Container Utama: Saya tambah 'gap-4' agar panah terpisah dari angka --}}
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center mt-10 gap-4">
        
        {{-- ========================== --}}
        {{-- 1. BAGIAN KIRI (PREVIOUS) --}}
        {{-- ========================== --}}
        <div class="flex-none">
            @if ($paginator->onFirstPage())
                {{-- Tombol Mati (Desain Kamu) --}}
                <span class="px-3 py-2 text-green-200 bg-green-800/70 rounded-xl cursor-not-allowed opacity-50 border border-transparent flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </span>
            @else
                {{-- Tombol Hidup (Desain Kamu) --}}
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" 
                   class="px-3 py-2 text-green-900 bg-white border border-transparent rounded-xl hover:bg-[#FBBF24] hover:text-black transition duration-300 shadow-md transform hover:-translate-y-1 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
            @endif
        </div>

        {{-- ========================== --}}
        {{-- 2. BAGIAN TENGAH (ANGKA)  --}}
        {{-- ========================== --}}
        {{-- Saya bungkus angka dlm div sendiri agar tetap rapat (gap-2) sesama angka --}}
        <div class="hidden md:flex items-center gap-2">
            @foreach ($elements as $element)
                
                {{-- "..." Separator (Desain Kamu) --}}
                @if (is_string($element))
                    <span class="px-4 py-2 text-white font-bold">{{ $element }}</span>
                @endif

                {{-- Array Link Halaman --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- HALAMAN AKTIF (Desain Kamu) --}}
                            <span aria-current="page" 
                                  class="px-4 py-2 text-black bg-[#FBBF24] border border-[#FBBF24] rounded-xl shadow-lg font-bold transform scale-110">
                                {{ $page }}
                            </span>
                        @else
                            {{-- HALAMAN TIDAK AKTIF (Desain Kamu) --}}
                            <a href="{{ $url }}" 
                               class="px-4 py-2 text-green-900 bg-white border border-transparent rounded-xl hover:bg-[#FBBF24] hover:text-black transition duration-300 shadow-sm font-semibold hover:-translate-y-1">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- ========================== --}}
        {{-- 3. BAGIAN KANAN (NEXT)    --}}
        {{-- ========================== --}}
        <div class="flex-none">
            @if ($paginator->hasMorePages())
                {{-- Tombol Hidup (Desain Kamu) --}}
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" 
                   class="px-3 py-2 text-green-900 bg-white rounded-xl hover:bg-[#FBBF24] hover:text-black transition duration-300 shadow-md transform hover:-translate-y-1 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @else
                {{-- Tombol Mati (Desain Kamu) --}}
                <span class="px-3 py-2 text-green-200 bg-green-800/70 rounded-xl cursor-not-allowed opacity-50 border border-transparent flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
            @endif
        </div>

    </nav>
@endif