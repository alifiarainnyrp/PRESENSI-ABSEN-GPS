<html>
<head>
    <title>Jadwal Cuti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
        <h1 class="text-2xl font-bold mb-4">Jadwal Cuti</h1>
        <table id="cutiTable" class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Nama</th>
                    <th class="py-2 px-4 border-b text-left">Tanggal Mulai</th>
                    <th class="py-2 px-4 border-b text-left">Tanggal Selesai</th>
                    <th class="py-2 px-4 border-b text-left">Keterangan</th>
                    <th class="py-2 px-4 border-b text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">John Doe</td>
                    <td class="py-2 px-4 border-b">2023-10-01</td>
                    <td class="py-2 px-4 border-b">2023-10-10</td>
                    <td class="py-2 px-4 border-b">Liburan Keluarga</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-red-500 text-white px-4 py-2 rounded flex items-center" onclick="hapusRow(this)">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">Jane Smith</td>
                    <td class="py-2 px-4 border-b">2023-11-05</td>
                    <td class="py-2 px-4 border-b">2023-11-15</td>
                    <td class="py-2 px-4 border-b">Cuti Melahirkan</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-red-500 text-white px-4 py-2 rounded flex items-center" onclick="hapusRow(this)">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 px-4 border-b">Michael Johnson</td>
                    <td class="py-2 px-4 border-b">2023-12-20</td>
                    <td class="py-2 px-4 border-b">2024-01-05</td>
                    <td class="py-2 px-4 border-b">Liburan Akhir Tahun</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-red-500 text-white px-4 py-2 rounded flex items-center" onclick="hapusRow(this)">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-4 flex">
            <button class="bg-blue-500 text-white px-4 py-2 rounded flex items-center mr-2" onclick="tambahCuti()">
                <i class="fas fa-plus mr-2"></i> Tambah Cuti
            </button>
            <a href="login.blade.php" class="bg-gray-500 text-white px-4 py-2 rounded flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <script>
        function tambahCuti() {
            const table = document.getElementById('cutiTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();

            const namaCell = newRow.insertCell(0);
            const tanggalMulaiCell = newRow.insertCell(1);
            const tanggalSelesaiCell = newRow.insertCell(2);
            const keteranganCell = newRow.insertCell(3);
            const aksiCell = newRow.insertCell(4);

            namaCell.className = 'py-2 px-4 border-b';
            tanggalMulaiCell.className = 'py-2 px-4 border-b';
            tanggalSelesaiCell.className = 'py-2 px-4 border-b';
            keteranganCell.className = 'py-2 px-4 border-b';
            aksiCell.className = 'py-2 px-4 border-b';

            namaCell.innerHTML = '<input type="text" class="border rounded px-2 py-1" placeholder="Nama">';
            tanggalMulaiCell.innerHTML = '<input type="date" class="border rounded px-2 py-1">';
            tanggalSelesaiCell.innerHTML = '<input type="date" class="border rounded px-2 py-1">';
            keteranganCell.innerHTML = '<input type="text" class="border rounded px-2 py-1" placeholder="Keterangan">';
            aksiCell.innerHTML = '<button class="bg-green-500 text-white px-4 py-2 rounded flex items-center" onclick="simpanRow(this)"><i class="fas fa-check mr-2"></i> Selesai</button>';
        }

        function hapusRow(button) {
            const row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function simpanRow(button) {
            const row = button.parentNode.parentNode;
            const inputs = row.getElementsByTagName('input');

            const nama = inputs[0].value;
            const tanggalMulai = inputs[1].value;
            const tanggalSelesai = inputs[2].value;
            const keterangan = inputs[3].value;

            if (nama && tanggalMulai && tanggalSelesai && keterangan) {
                row.innerHTML = `
                    <td class="py-2 px-4 border-b">${nama}</td>
                    <td class="py-2 px-4 border-b">${tanggalMulai}</td>
                    <td class="py-2 px-4 border-b">${tanggalSelesai}</td>
                    <td class="py-2 px-4 border-b">${keterangan}</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-red-500 text-white px-4 py-2 rounded flex items-center" onclick="hapusRow(this)">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </td>
                `;
            } else {
                alert('Semua kolom harus diisi!');
            }
        }
    </script>
</body>
</html>