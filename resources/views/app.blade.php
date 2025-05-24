<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Spotify OAuth</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-8">Test Spotify API</h1>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="/auth/spotify" class="bg-green-500 hover:bg-green-600 px-8 py-4 rounded-lg text-xl font-semibold">
            🎵 Se connecter avec Spotify
        </a>
    </div>
</body>

</html>