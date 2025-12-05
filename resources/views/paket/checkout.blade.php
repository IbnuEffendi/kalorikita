<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemesanan | KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>

<body class="bg-[#F4F8F2] font-sans relative pb-20">

    <x-navbar></x-navbar>

    <section class="relative bg-green-800 text-white py-16">
        <div class="absolute inset-0">
            {{-- REVISI: Gambar Header Statis (Tetap) sesuai file asli kamu --}}
            <img src="/asset/header-paket.jpeg" class="w-full h-full object-cover" alt="Header Pemesanan" />
            {{-- Overlay Gelap --}}
            <div class="absolute inset-0 bg-green-900/60"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 text-left">
            <h1 class="text-4xl font-bold mb-2">Pemesanan</h1>
            <p class="text-lg font-medium">
                Lengkapi data pengiriman untuk Paket {{ $paketOption->category->nama_kategori }}
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 mt-10">
        <div class="flex items-center justify-center space-x-6 text-sm font-medium text-gray-600">

            <div class="flex items-center space-x-2">
                <div
                    class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-semibold">
                    1
                </div>
                <span class="text-green-700 font-bold">Data & Pengiriman</span>
            </div>

            <div class="w-16 h-0.5 bg-gray-300"></div>

            <div class="flex items-center space-x-2">
                <div
                    class="w-6 h-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs font-semibold">
                    2
                </div>
                <span class="text-gray-400">Pembayaran</span>
            </div>

            <div class="w-16 h-0.5 bg-gray-300"></div>

            <div class="flex items-center space-x-2">
                <div
                    class="w-6 h-6 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs font-semibold">
                    3
                </div>
                <span class="text-gray-400">Konfirmasi</span>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-12 flex flex-col lg:flex-row gap-10 relative z-10">

        <div class="bg-white shadow-md rounded-2xl p-8 flex-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">Detail Pengiriman</h2>

            <form id="orderForm" class="space-y-6" method="POST" action="{{ route('paket.payment') }}">
                @csrf
                {{-- DATA PENTING: ID Paket (Hidden) --}}
                <input type="hidden" name="paket_option_id" value="{{ $paketOption->id }}">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Paket Dipilih</label>
                    <input type="text"
                        value="Paket {{ $paketOption->category->nama_kategori }} ({{ $paketOption->durasi_hari }} Hari)"
                        readonly
                        class="w-full border border-gray-300 bg-gray-100 text-gray-500 rounded-lg p-3 focus:outline-none cursor-not-allowed font-medium" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ Auth::check() ? Auth::user()->name : '' }}"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        placeholder="Masukkan nama lengkap penerima" required />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor WhatsApp</label>
                    <input type="number" name="whatsapp"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        placeholder="Contoh: 081234567890" required />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        placeholder="Nama Jalan, No. Rumah, RT/RW, Patokan..." required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Makanan (Opsional)</label>
                    <input type="text" name="catatan"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none transition"
                        placeholder="Contoh: Tanpa pedas, alergi udang" />
                </div>

                <div class="hidden">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Metode Pembayaran</label>
                    <div class="grid grid-cols-3 gap-3">
                        <button type="button"
                            class="py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold bg-gray-50 hover:bg-gray-100 transition">Transfer</button>
                        <button type="button"
                            class="py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold bg-gray-50 hover:bg-gray-100 transition">QRIS</button>
                        <button type="button"
                            class="py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold bg-gray-50 hover:bg-gray-100 transition">Kartu
                            Kredit</button>
                    </div>
                </div>

                <div class="hidden">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Voucher</label>
                    <div class="flex gap-3">
                        <input type="text" placeholder="KODEPROMO"
                            class="flex-1 border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none" />
                        <button type="button"
                            class="px-5 py-3 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-200 transition">Terapkan</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="lg:w-1/3">
            <div class="bg-white shadow-md rounded-2xl p-6 sticky top-24 border border-gray-50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan</h3>

                <div class="space-y-4 text-gray-700">

                    {{-- Detail Paket --}}
                    <div class="border-b border-gray-100 pb-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="font-bold text-gray-800 text-lg">Paket
                                {{ $paketOption->category->nama_kategori }}</span>
                        </div>

                        {{-- Info Spesifikasi Paket --}}
                        <div
                            class="bg-green-50 rounded-lg p-3 text-xs text-gray-600 space-y-1.5 border border-green-100">
                            <div class="flex justify-between">
                                <span><i class="far fa-calendar mr-1 text-green-600"></i> Durasi</span>
                                <span class="font-bold">{{ $paketOption->durasi_hari }} Hari</span>
                            </div>
                            <div class="flex justify-between">
                                <span><i class="fas fa-box-open mr-1 text-green-600"></i> Total Box</span>
                                <span class="font-bold">{{ $totalBox }} Box</span>
                            </div>
                            <div class="flex justify-between">
                                <span><i class="fas fa-fire mr-1 text-green-600"></i> Kalori</span>
                                <span class="font-bold">{{ $paketOption->category->range_kalori }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span><i class="fas fa-dumbbell mr-1 text-green-600"></i> Protein</span>
                                <span class="font-bold">{{ $paketOption->category->level_protein }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Rincian Biaya --}}
                    <div class="flex justify-between text-sm">
                        <span>Harga Paket</span>
                        <span>Rp {{ number_format($paketOption->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Ongkir</span>
                        <span class="text-green-600 font-bold">Gratis</span>
                    </div>

                    <div class="flex justify-between hidden">
                        <span>Diskon</span>
                        <span class="text-red-500 font-medium">- Rp 0</span>
                    </div>

                    <div class="border-t border-gray-200 pt-4 flex justify-between items-center mt-2">
                        <span class="font-bold text-gray-800 text-lg">Total Bayar</span>
                        <span class="font-extrabold text-[#1F5A34] text-xl">Rp
                            {{ number_format($paketOption->harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button onclick="document.getElementById('orderForm').submit();"
                    class="block w-full mt-8 py-3.5 bg-yellow-400 hover:bg-yellow-600 text-black font-bold rounded-xl text-center transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                    Lanjut Pembayaran <i class="fas fa-arrow-right text-xs"></i>
                </button>




                <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-400">
                    <i class="fas fa-lock"></i> Pembayaran aman & terenkripsi
                </div>
            </div>
        </div>
    </section>

    <div class="pointer-events-none fixed bottom-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute bottom-0 left-0 w-[220px] h-[220px] opacity-40 bg-no-repeat bg-contain"
            style="background-image:url('/asset/doodle-left.png');"></div>
        <div class="absolute bottom-0 left-0 w-[380px] h-[380px] opacity-40 bg-no-repeat bg-contain"
            style="background-image:url('/asset/kiri bawah.png'); background-position: bottom left; transform: translate(-10px, 10px);">
        </div>
        <div class="absolute bottom-[-50px] right-[-50px] w-[380px] h-[380px] opacity-40 bg-no-repeat bg-contain"
            style="background-image:url('/asset/kanan bawah.png');"></div>
    </div>

    <script>
        const payButton = document.getElementById('btn-pay');
        const orderForm = document.getElementById('orderForm');

        if (payButton && orderForm) {
            payButton.addEventListener('click', function(e) {
                e.preventDefault();

                const formData = new FormData(orderForm);

                fetch("{{ route('paket.payment') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.snapToken) {
                            alert("Gagal memulai pembayaran. Silakan coba lagi.");
                            console.error(data);
                            return;
                        }

                        // Tampilkan popup Midtrans
                        snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                // redirect ke halaman sukses kamu
                                window.location.href = "{{ route('pesanan.success') }}";
                            },
                            onPending: function(result) {
                                // kalau mau beda: bisa route lain atau sama
                                window.location.href = "{{ route('pesanan.success') }}";
                            },
                            onError: function(result) {
                                alert("Terjadi kesalahan saat pembayaran.");
                                console.error(result);
                            },
                            onClose: function() {
                                // user nutup popup tanpa bayar
                                alert("Kamu menutup jendela pembayaran sebelum selesai.");
                            }
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Gagal menghubungi server. Coba lagi sebentar lagi.");
                    });
            });
        }
    </script>


</body>

</html>
