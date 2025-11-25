<div id="logout-modal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-sm text-center">
        <h3 class="text-xl font-semibold mb-4 text-gray-900">Yakin mau keluar akun?</h3>
        <p class="text-sm text-gray-600 mb-6">Anda harus masuk kembali untuk mengakses dashboard Anda.</p>
        
        <div class="flex justify-center gap-4">
            <button id="batal-logout-btn" class="flex-1 rounded-full bg-gray-200 px-6 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300 transition-all">
                Batal
            </button>

            <form action="{{ route('logout') }}" method="POST" class="flex-1">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 rounded-full bg-green-800 px-6 py-2 text-sm font-semibold text-white hover:bg-green-700 transition-all">
                    <i class='bx bx-log-out text-lg'></i>
                    Ya, Keluar
                </button>
            </form>
        </div>
    </div>
</div>