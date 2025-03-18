<html>
<head>
    <title>Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-blue-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md">
        <!-- Create Account -->
        <div class="bg-white rounded-lg p-6 shadow-md">
            <h2 class="text-center text-2xl font-semibold mb-4">Create Account</h2>
            <form class="space-y-4" action="{{ url('/register') }}" method="POST" onsubmit="return validateForm()">
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="NIK" type="text" name="nik" id="nik"/>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email" type="email" name="email" id="email"/>
                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password" type="password" name="password" id="password"/>
                <a href="login.blade.php" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 text-center block" onclick="return validateForm()">Sign In</a>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const nik = document.getElementById('nik').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!nik || !email || !password) {
                alert('Please fill in all fields.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>