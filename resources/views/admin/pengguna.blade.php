<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pengguna | Admin KaloriKita</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Sidebar -->
  <x-sidebar></x-sidebar>

  <!-- Main Content -->
  <main class="ml-64 p-6">

    <!-- Filter + Search -->
    <div class="flex flex-wrap justify-between mb-4 gap-4">
      <input type="text" placeholder="Cari nama atau email..." class="flex-1 border p-2 rounded shadow">
      <select class="border p-2 rounded shadow">
        <option value="">Semua Status</option>
        <option value="aktif">Aktif</option>
        <option value="non-aktif">Non-Aktif</option>
      </select>
    </div>

    <!-- Tabel Pengguna -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
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
            <td class="p-3">Andi Pratama</td>
            <td class="p-3">andi@example.com</td>
            <td class="p-3">01/10/2024</td>
            <td class="p-3 text-green-600 font-semibold">Aktif</td>
            <td class="p-3">
              <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Detail</button>
              <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Non-Aktifkan</button>
            </td>
          </tr>
          <tr class="border-b hover:bg-gray-50">
            <td class="p-3">Maria Pertiwi</td>
            <td class="p-3">maria@gmail.com</td>
            <td class="p-3">05/09/2024</td>
            <td class="p-3 text-red-600 font-semibold">Non-Aktif</td>
            <td class="p-3">
              <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Detail</button>
              <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Aktifkan</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </main>

</body>
</html>