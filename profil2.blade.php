<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Akun Absen</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
        }
        .logout-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logout-container h2 {
            margin-bottom: 10px;
        }
        .logout-button {
            background-color: #dc2626;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>Keluar dari Akun Absen</h2>
        <p>Apakah Anda yakin ingin keluar?</p>
        <button class="logout-button" onclick="logout()">Keluar</button>
    </div>

    <script>
        function logout() {
            // Hapus sesi atau token login di sini
            alert("Anda telah keluar.");
            window.location.href = "index.php"; // Arahkan ke halaman login
        }
    </script>
</body>
</html>