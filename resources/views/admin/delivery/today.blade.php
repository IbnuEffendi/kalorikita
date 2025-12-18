<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Delivery Hari Ini - Admin KaloriKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-700/60 min-h-screen">
<x-navbar/>

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 mb-6">
        <h1 class="text-2xl font-bold text-white">Delivery Hari Ini</h1>
        <p class="text-xs text-green-200/70 mt-1">
            Tanggal: {{ \Carbon\Carbon::parse($today)->format('d M Y') }}
        </p>
    </div>

    {{-- Tabel --}}
    <div class="bg-green-800/90 border border-green-700/70 rounded-3xl p-6 shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-green-50">
                <thead class="text-green-200 border-b border-green-700">
                    <tr>
                        <th class="py-3 text-left">User</th>
                        <th class="py-3 text-left">Paket</th>
                        <th class="py-3 text-left">Menu Siang</th>
                        <th class="py-3 text-center">Siang</th>
                        <th class="py-3 text-left">Menu Malam</th>
                        <th class="py-3 text-center">Malam</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-700/60">
                @forelse($orders as $order)
                    @php
                        $schedule = $menuSchedules[$order->paket_category_id] ?? null;
                        $log = $deliveryLogs[$order->id] ?? null;
                    @endphp
                    <tr>
                        <td class="py-3">
                            <div class="font-semibold">{{ $order->user->name }}</div>
                            <div class="text-[10px] text-green-200/60">{{ $order->order_code }}</div>
                        </td>

                        <td class="py-3">{{ $order->paketCategory->nama_kategori }}</td>

                        {{-- Lunch --}}
                        <td class="py-3">
                            {{ $schedule?->lunchMenu?->nama_menu ?? '-' }}
                        </td>
                        <td class="py-3 text-center">
                            @if(($log->lunch_status ?? 'pending') === 'delivered')
                                <span class="text-green-400 font-bold">✔</span>
                            @else
                                <form method="POST" action="{{ route('admin.delivery.update') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="type" value="lunch">
                                    <button class="px-3 py-1 rounded bg-yellow-400 text-green-900 font-bold text-[10px]">
                                        Deliver
                                    </button>
                                </form>
                            @endif
                        </td>

                        {{-- Dinner --}}
                        <td class="py-3">
                            {{ $schedule?->dinnerMenu?->nama_menu ?? '-' }}
                        </td>
                        <td class="py-3 text-center">
                            @if(($log->dinner_status ?? 'pending') === 'delivered')
                                <span class="text-green-400 font-bold">✔</span>
                            @else
                                <form method="POST" action="{{ route('admin.delivery.update') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="type" value="dinner">
                                    <button class="px-3 py-1 rounded bg-yellow-400 text-green-900 font-bold text-[10px]">
                                        Deliver
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center text-green-200/50">
                            Tidak ada delivery hari ini.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
