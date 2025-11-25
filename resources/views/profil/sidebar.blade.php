<aside class="w-1/4 bg-green-900 text-white p-8 relative overflow-y-auto">
    
    <div class="absolute inset-0 bg-repeat opacity-10" style="background-image: url('{{ asset('asset/pattern-kiri.png') }}')"></div>

    <nav class="mt-4 space-y-4 relative z-10">
        
        <a href="/profil" 
           class="flex items-center gap-3 p-3 rounded-lg transition-all
                  {{ ($activePage == 'profil') 
                     ? 'bg-white/40 font-semibold' 
                     : 'hover:bg-white/10 font-medium opacity-80' }}">
            
            <i class='bx  bx-user text-xl'></i> 

            <span>Informasi Akun</span>
        </a>
        
        <a href="/myorder" 
           class="flex items-center gap-3 p-3 rounded-lg transition-all
                  {{ ($activePage == 'pesanan') 
                     ? 'bg-white/40 font-semibold' 
                     : 'hover:bg-white/10 font-medium opacity-80' }}">

            <i class='bx  bx-shopping-bag text-xl'></i> 

            <span>Pesanan Saya</span>
        </a>
        
        <a href="/kalori-tracker" 
           class="flex items-center gap-3 p-3 rounded-lg transition-all
                  {{ ($activePage == 'tracker') 
                     ? 'bg-white/40 font-semibold' 
                     : 'hover:bg-white/10 font-medium opacity-80' }}">
            
            <i class='bx  bx-dumbbell text-xl'></i>

            <span>Kalori Tracker</span>
        </a>
        
        <a href="/logout-modal" id="tombol-logout-palsu" class="flex items-center gap-3 p-3 hover:bg-white/10 rounded-lg font-medium opacity-80 transition-all">
            <i class='bx bx-log-out text-lg'></i>
            <span>Keluar</span>
        </a>
    </nav>
</aside>