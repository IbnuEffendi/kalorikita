<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Admin KaloriKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Sidebar -->
  <x-sidebar></x-sidebar>

  <!-- Main Content -->
  <main class="ml-64 p-6">

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-3 gap-6 mb-6">
      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-gray-500 text-sm">Pengguna</h2>
        <p class="text-2xl font-bold">1245</p>
      </div>
      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-gray-500 text-sm">Transaksi</h2>
        <p class="text-2xl font-bold">187</p>
      </div>
      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-gray-500 text-sm">Pendapatan</h2>
        <p class="text-2xl font-bold">Rp 2.345.678</p>
      </div>
    </div>

    <!-- Pendapatan Bulanan + Grafik -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
      <h2 class="font-semibold mb-4">Pendapatan Bulanan</h2>
      <canvas id="monthlyRevenueChart" class="w-full h-64"></canvas>
    </div>

    <!-- Data Admin -->
    <div class="bg-white rounded-lg shadow p-4">
      <h2 class="font-semibold mb-4">Data Admin</h2>
      <div class="overflow-x-auto">
        <table class="w-full text-left border border-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-3 border-b">Nama</th>
              <th class="p-3 border-b">Email</th>
              <th class="p-3 border-b">Tanggal Bergabung</th>
              <th class="p-3 border-b">Status</th>
              <th class="p-3 border-b">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">Admin KaloriKita</td>
              <td class="p-3">admin@kalorikita.com</td>
              <td class="p-3">01/10/2024</td>
              <td class="p-3 text-green-600 font-semibold">Aktif</td>
              <td class="p-3">
                <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Detail</button>
                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Non-Aktifkan</button>
              </td>
            </tr>
            <!-- Bisa tambah admin lain di sini -->
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
          label: 'Pendapatan',
          data: [120000, 150000, 180000, 200000, 240000, 210000, 250000, 230000, 260000, 270000, 300000, 320000],
          borderColor: '#10B981',
          backgroundColor: 'rgba(16,185,129,0.1)',
          fill: true,
          tension: 0.3
        }]
      },
      options: { responsive: true, plugins: { legend: { display: false } } }
    });
  </script>

</body>
</html>