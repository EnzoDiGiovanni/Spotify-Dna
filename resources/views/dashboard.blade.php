<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Test Spotify</title>
  @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-900 text-white min-h-screen p-8">
  <div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-8">🎵 Tes Top Tracks Spotify</h1>

    <a href="/" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded mb-8 inline-block">
      ← Retour
    </a>

    @if(isset($data['items']))
    <div class="grid gap-4">
      @foreach($data['items'] as $track)
      <div class="bg-gray-800 p-4 rounded-lg flex items-center space-x-4">
      @if(isset($track['album']['images'][2]))
      <img src="{{ $track['album']['images'][2]['url'] }}" alt="Cover" class="w-16 h-16 rounded">
    @endif
      <div>
      <h3 class="font-bold text-lg">{{ $track['name'] }}</h3>
      <p class="text-gray-400">
      {{ collect($track['artists'])->pluck('name')->join(', ') }}
      </p>
      <p class="text-sm text-gray-500">{{ $track['album']['name'] }}</p>
      </div>
      </div>
    @endforeach
    </div>
  @else
    <p class="text-red-500">Aucune donnée trouvée</p>
    <pre class="bg-gray-800 p-4 rounded mt-4 text-sm">{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
  @endif
  </div>
</body>

</html>