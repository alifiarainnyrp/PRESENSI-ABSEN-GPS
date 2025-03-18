<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-presensi</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #87CEFA, #fff);
            font-family: 'Roboto', sans-serif;
            text-align: center;
            color: #333;
        }

        .appHeader {
            background-color: #87CEEB;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 3px solid #4682B4;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: white;
            border-radius: 0 0 20px 20px;
        }

        .webcam-capture {
            border: 5px dashed #4682B4;
            border-radius: 15px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.6);
            display: inline-block;
        }

        .result-container {
            margin-top: 20px;
            padding: 20px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.6);
            display: inline-block;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #snapshot {
            width: 100%;
            max-width: 680px;
            margin-top: 10px;
            border: 5px solid #4682B4;
            border-radius: 15px;
            display: none;
        }

        #location-info, #success-message {
            margin-top: 10px;
            font-weight: bold;
        }

        #success-message {
            color: green;
            display: none;
        }

        iframe {
            width: 100%;
            max-width: 680px;
            height: 300px;
            border-radius: 15px;
            display: none;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn {
            padding: 12px 25px;
            font-size: 18px;
            background-color: #FFD700;
            color: #333;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.2);
            margin: 5px;
        }

        .btn:hover {
            background-color: #FFA500;
            transform: scale(1.1);
        }

        .btn-danger {
            background-color: #FF6B6B;
            color: white;
        }

        .btn-danger:hover {
            background-color: #E63946;
        }

        .btn-view-absen {
            display: none;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
        }

        .btn-view-absen:hover {
            background-color: #45A049;
        }

        .btn-status {
            background-color: #87CEEB;
            color: white;
        }

        .btn-status:hover {
            background-color: #4682B4;
        }

    </style>
</head>
<body>
    <div class="appHeader">☁️ Absen Masuk ☁️</div>

    <div class="row" style="margin-top: 50px">
        <div class="col text-center">
            <div class="webcam-capture"></div>
            <div class="btn-container">
                <button class="btn" onclick="takeSnapshot()">📸 Ambil Foto</button>
                <button class="btn btn-danger" onclick="clearSnapshot()">❌ Hapus Foto</button>
                <button class="btn btn-status" onclick="setStatus('Hadir')">✅ Hadir</button>
                <button class="btn btn-status" onclick="setStatus('Sakit')">🤒 Sakit</button>
                <button class="btn btn-status" onclick="setStatus('Izin')">📝 Izin</button>
            </div>
            <div class="result-container">
                <h5>🌟 Hasil Foto 🌟</h5>
                <img id="snapshot" src="" alt="Hasil Foto">
                <p id="location-info"></p>
                <iframe id="map-frame" src=""></iframe>
                <p id="success-message">✅ Absen berhasil disimpan!</p>
                <a id="view-absen" href="javascript:void(0)" class="btn btn-view-absen" onclick="showRiwayat()">📂 Lihat Absen</a>
            </div>
        </div>
    </div>

    <div id="riwayatAbsen" class="container mx-auto p-4 hidden">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Riwayat Absen</h1>
            <div class="flex justify-between items-center mb-4">
                <button onclick="hideRiwayat()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </button>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200">Tanggal</th>
                        <th class="py-2 px-4 border-b border-gray-200">Waktu</th>
                        <th class="py-2 px-4 border-b border-gray-200">Latitude</th>
                        <th class="py-2 px-4 border-b border-gray-200">Longitude</th>
                        <th class="py-2 px-4 border-b border-gray-200">Status</th>
                        <th class="py-2 px-4 border-b border-gray-200">Foto</th>
                    </tr>
                </thead>
                <tbody id="riwayatTableBody">
                    <!-- Riwayat absen akan muncul di sini -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let currentStatus = '';

        Webcam.set({
            height: 480,
            width: 680,
            image_format: 'jpeg',
            jpeg_quality: 80
        });

        Webcam.attach('.webcam-capture');

        function takeSnapshot() {
            if (!currentStatus) {
                alert('Silakan pilih status terlebih dahulu.');
                return;
            }
            Webcam.snap(function (data_uri) {
                let snapshot = document.getElementById('snapshot');
                snapshot.src = data_uri;
                snapshot.style.display = "block";
                getLocation(data_uri);
            });
        }

        function clearSnapshot() {
            document.getElementById('snapshot').src = "";
            document.getElementById('snapshot').style.display = "none";
            document.getElementById('location-info').innerText = "";
            document.getElementById('map-frame').style.display = "none";
            document.getElementById('success-message').style.display = "none";
            document.getElementById('view-absen').style.display = "none";
            currentStatus = '';
        }

        function setStatus(status) {
            currentStatus = status;
            alert(`Status diatur ke: ${status}`);
        }

        function getLocation(imageData) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => showPosition(position, imageData), showError);
            } else {
                document.getElementById("location-info").innerText = "Geolocation tidak didukung oleh browser ini.";
            }
        }

        function showPosition(position, imageData) {
            let lat = position.coords.latitude;
            let lon = position.coords.longitude;
            document.getElementById("location-info").innerText = `Lokasi Anda: ${lat}, ${lon}`;
            let mapFrame = document.getElementById("map-frame");
            mapFrame.src = `https://www.google.com/maps?q=${lat},${lon}&output=embed`;
            mapFrame.style.display = "block";

            // Simpan data ke localStorage
            saveToLocalStorage(imageData, lat, lon);
        }

        function showError(error) {
            let errorMsg = "Terjadi kesalahan yang tidak diketahui.";
            if (error.code === error.PERMISSION_DENIED) {
                errorMsg = "Pengguna menolak permintaan lokasi.";
            } else if (error.code === error.POSITION_UNAVAILABLE) {
                errorMsg = "Informasi lokasi tidak tersedia.";
            } else if (error.code === error.TIMEOUT) {
                errorMsg = "Permintaan lokasi timeout.";
            }
            document.getElementById("location-info").innerText = errorMsg;
        }

        function saveToLocalStorage(imageData, lat, lon) {
            let absenData = JSON.parse(localStorage.getItem('absenData')) || [];
            const currentDate = new Date();
            const tanggal = currentDate.toISOString().split('T')[0];
            const waktu = currentDate.toTimeString().split(' ')[0];

            absenData.push({ tanggal, waktu, latitude: lat, longitude: lon, status: currentStatus, foto: imageData });
            localStorage.setItem('absenData', JSON.stringify(absenData));

            document.getElementById('success-message').style.display = "block";
            document.getElementById('view-absen').style.display = "inline-block";
        }

        function showRiwayat() {
            document.querySelector('.row').style.display = 'none';
            document.getElementById('riwayatAbsen').classList.remove('hidden');
            renderTable();
        }

        function hideRiwayat() {
            document.querySelector('.row').style.display = 'block';
            document.getElementById('riwayatAbsen').classList.add('hidden');
        }

        function renderTable() {
            const riwayatTableBody = document.getElementById('riwayatTableBody');
            let absenData = JSON.parse(localStorage.getItem('absenData')) || [];

            riwayatTableBody.innerHTML = '';
            absenData.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="py-2 px-4 border-b border-gray-200">${item.tanggal}</td>
                    <td class="py-2 px-4 border-b border-gray-200">${item.waktu}</td>
                    <td class="py-2 px-4 border-b border-gray-200">${item.latitude}</td>
                    <td class="py-2 px-4 border-b border-gray-200">${item.longitude}</td>
                    <td class="py-2 px-4 border-b border-gray-200">${item.status}</td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <img src="${item.foto}" alt="Foto absen pada ${item.tanggal} jam ${item.waktu}" class="w-16 h-16 object-cover rounded-full">
                    </td>
                `;
                riwayatTableBody.appendChild(row);
            });
        }
    </script>
</body>
</html>