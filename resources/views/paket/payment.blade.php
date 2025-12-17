<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran | KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    {{-- Snap Midtrans (sandbox) --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        .payment-option.active {
            border-color: #166534;
            background-color: #F0FDF4;
            color: #166534;
        }

        .payment-option.active .check-icon {
            display: block;
        }
    </style>
</head>


<body class="bg-[#F4F8F2] font-sans relative pb-20">

    <x-navbar></x-navbar>

    <section class="relative bg-green-800 text-white py-16">
        <div class="absolute inset-0">
            <img src="/asset/header-paket.jpeg" class="w-full h-full object-cover" alt="Header Pemesanan" />
            <div class="absolute inset-0 bg-green-900/60"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 text-left">
            <h1 class="text-4xl font-bold mb-2">Pembayaran</h1>
            <p class="text-lg font-medium">
                Pilih metode pembayaran untuk menyelesaikan pesanan.
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 mt-10">
        <div class="flex items-center justify-center space-x-6 text-sm font-medium text-gray-600">

            <div class="flex items-center space-x-2">
                <div
                    class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-semibold">
                    <i class="fas fa-check"></i>
                </div>
                <span class="text-green-700 font-bold">Data & Pengiriman</span>
            </div>

            <div class="w-16 h-0.5 bg-green-600"></div>

            <div class="flex items-center space-x-2">
                <div
                    class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-semibold">
                    2
                </div>
                <span class="text-green-700 font-bold">Pembayaran</span>
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

            <div class="mb-8 border-b border-gray-100 pb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Review Data Pengiriman</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nama (Ambil dari data step sebelumnya) --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Nama Penerima</label>
                        <input type="text" value="{{ $data['nama'] }}" readonly
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg p-2.5 text-gray-600 text-sm focus:outline-none cursor-not-allowed">
                    </div>
                    {{-- WhatsApp --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1">Nomor Telepon</label>
                        <input type="text" value="{{ $data['whatsapp'] }}" readonly
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg p-2.5 text-gray-600 text-sm focus:outline-none cursor-not-allowed">
                    </div>
                    {{-- Alamat --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-500 mb-1">Alamat</label>
                        <textarea readonly
                            class="w-full bg-gray-100 border border-gray-200 rounded-lg p-2.5 text-gray-600 text-sm focus:outline-none cursor-not-allowed"
                            rows="2">{{ $data['alamat'] }}</textarea>
                    </div>
                    {{-- Catatan (Jika ada) --}}
                    @if (!empty($data['catatan']))
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-gray-500 mb-1">Catatan</label>
                            <input type="text" value="{{ $data['catatan'] }}" readonly
                                class="w-full bg-gray-100 border border-gray-200 rounded-lg p-2.5 text-gray-600 text-sm focus:outline-none cursor-not-allowed">
                        </div>
                    @endif
                </div>
            </div>

            <form id="paymentForm" action="#" method="POST"> @csrf

                {{-- PENTING: Kirim ulang data user & paket ke tahap selanjutnya (Hidden) --}}
                <input type="hidden" name="paket_option_id" value="{{ $paketOption->id }}">
                <input type="hidden" name="nama" value="{{ $data['nama'] }}">
                <input type="hidden" name="whatsapp" value="{{ $data['whatsapp'] }}">
                <input type="hidden" name="alamat" value="{{ $data['alamat'] }}">
                <input type="hidden" name="catatan" value="{{ $data['catatan'] ?? '' }}">

                {{-- Input Hidden untuk menyimpan metode pembayaran yg dipilih JS --}}
                <input type="hidden" name="metode_pembayaran" id="input-payment-method" required>

                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Pilih Metode Pembayaran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                        <div class="payment-option cursor-pointer border border-gray-300 rounded-xl p-4 hover:border-green-500 transition flex items-center gap-3 relative overflow-hidden"
                            onclick="selectPayment(this, 'Transfer Bank')">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                                <i class="fas fa-university"></i>
                            </div>
                            <span class="font-bold text-gray-700 text-sm">Transfer Bank</span>
                            {{-- Icon Ceklis (Hidden by default) --}}
                            <div class="check-icon hidden absolute top-2 right-2 text-green-600">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>

                        <div class="payment-option cursor-pointer border border-gray-300 rounded-xl p-4 hover:border-green-500 transition flex items-center gap-3 relative overflow-hidden"
                            onclick="selectPayment(this, 'QRIS')">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <span class="font-bold text-gray-700 text-sm">QRIS</span>
                            <div class="check-icon hidden absolute top-2 right-2 text-green-600">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>

                        <div
                            class="payment-option border border-gray-200 rounded-xl p-4 bg-gray-50 opacity-60 flex items-center gap-3 cursor-not-allowed">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <span class="font-bold text-gray-400 text-sm">Kartu Kredit</span>
                        </div>
                    </div>
                    {{-- Pesan Error kalau belum pilih --}}
                    <p id="error-payment" class="text-red-500 text-xs mt-2 hidden">
                        <i class="fas fa-exclamation-circle"></i> Silakan pilih salah satu metode pembayaran.
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Punya Kode Voucher?</label>
                    <div class="flex gap-3">
                        <input type="text" name="voucher" placeholder="Contoh: HEMAT10"
                            class="flex-1 border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none" />
                        <button type="button" onclick="alert('Kode voucher berhasil digunakan! (Simulasi)')"
                            class="px-5 py-3 bg-gray-100 border border-gray-300 rounded-lg font-bold text-gray-600 hover:bg-gray-200 transition">
                            Pakai
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="lg:w-1/3">
            <div class="bg-white shadow-md rounded-2xl p-6 sticky top-24 border border-gray-50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan Pesanan</h3>

                <div class="space-y-4 text-gray-700">

                    {{-- Detail Paket (SAMA PERSIS) --}}
                    <div class="border-b border-gray-100 pb-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="font-bold text-gray-800 text-lg">Paket
                                {{ $paketOption->category->nama_kategori }}</span>
                        </div>

                        {{-- Info Spesifikasi Paket (SAMA PERSIS) --}}
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

                    {{-- Rincian Biaya (SAMA PERSIS) --}}
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

                <button onclick="submitPayment()"
                    class="block w-full mt-8 py-3.5 bg-yellow-400 hover:bg-yellow-600 text-black font-bold rounded-xl text-center transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                    Konfirmasi Pembayaran <i class="fas fa-check-circle text-sm"></i>
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
        function selectPayment(element, value) {
            document.querySelectorAll('.payment-option').forEach(el => {
                el.classList.remove('active', 'border-green-600', 'bg-green-50');
                const checkIcon = el.querySelector('.check-icon');
                if (checkIcon) checkIcon.classList.add('hidden');
            });

            element.classList.add('active', 'border-green-600', 'bg-green-50');
            element.querySelector('.check-icon').classList.remove('hidden');

            document.getElementById('input-payment-method').value = value;
            document.getElementById('error-payment').classList.add('hidden');
        }

        function submitPayment() {
            const method = document.getElementById('input-payment-method').value;

            if (!method) {
                document.getElementById('error-payment').classList.remove('hidden');
                document.getElementById('paymentForm').scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
                return;
            }

            const token = "{{ $snapToken ?? ($order->midtrans_snap_token ?? '') }}";

            if (!token) {
                alert('Snap token kosong. Cek konfigurasi Midtrans di backend.');
                return;
            }

            snap.pay(token, {
                onSuccess: function(result) {
                    window.location.href = "{{ route('pesanan.success') }}";
                },
                onPending: function(result) {
                    window.location.href = "{{ route('pesanan.success') }}";
                },
                onError: function(result) {
                    alert("Terjadi kesalahan saat pembayaran.");
                    console.error(result);
                },
                onClose: function() {
                    alert("Kamu menutup jendela pembayaran sebelum selesai.");
                }
            });
        }
    </script>



</body>

</html>
