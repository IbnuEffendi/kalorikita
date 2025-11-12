<aside class="w-1/4 bg-[#0B7932] text-white p-8 relative overflow-y-auto">
    
    <div class="absolute inset-0 bg-repeat opacity-10" style="background-image: url('{{ asset('asset/pattern-kiri.png') }}')"></div>

    <nav class="mt-4 space-y-4 relative z-10">
        
        <a href="/profil" 
           class="flex items-center gap-3 p-3 rounded-lg transition-all
                  {{ ($activePage == 'profil') 
                     ? 'bg-white/40 font-semibold' 
                     : 'hover:bg-white/10 font-medium opacity-80' }}">
            <span>Informasi Akun</span>
        </a>
        
        <a href="/myorder" 
           class="flex items-center gap-3 p-3 rounded-lg transition-all
                  {{ ($activePage == 'pesanan') 
                     ? 'bg-white/40 font-semibold' 
                     : 'hover:bg-white/10 font-medium opacity-80' }}">
            <span>Pesanan Saya</span>
        </a>
        
        <a href="#" 
           class="flex items-center gap-3 p-3 rounded-lg transition-all
                  {{ ($activePage == 'tracker') 
                     ? 'bg-white/40 font-semibold' 
                     : 'hover:bg-white/10 font-medium opacity-80' }}">
            <span>Kalori Tracker</span>
        </a>
        
        <a href="/logout-modal" id="tombol-logout-palsu" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg font-medium opacity-80 transition-all">
            <span>Keluar</span>
        </a>
    </nav>
</aside>