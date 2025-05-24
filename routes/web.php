<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/spotify-test', function () {
    $token = session('spotify_token');

    if (!$token) {
        return response()->json(['error' => 'Pas de token Spotify']);
    }

    // Test API Spotify
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token
    ])->get('https://api.spotify.com/v1/me/top/artists?limit=20');

    return response()->json([
        'token' => $token,
        'api_response' => $response->json(),
        'status' => $response->status()
    ]);
});

// Route pour rediriger vers Spotify
Route::get('/auth/spotify', function () {
    $scopes = 'user-top-read user-read-recently-played user-read-currently-playing user-read-playback-state';

    $query = http_build_query([
        'client_id' => env('SPOTIFY_CLIENT_ID'),
        'response_type' => 'code',
        'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
        'scope' => $scopes,
    ]);

    return redirect('https://accounts.spotify.com/authorize?' . $query);
});

// Route callback après autorisation
Route::get('/auth/spotify/callback', function () {
    $code = request('code');
    $error = request('error');

    // Debug ce qui arrive
    if ($error) {
        dd('Erreur Spotify:', $error);
    }

    if (!$code) {
        dd('Pas de code reçu', request()->all());
    }

    // Échanger le code contre un token
    $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
        'client_id' => env('SPOTIFY_CLIENT_ID'),
        'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
    ]);

    // Debug la réponse
    if ($response->failed()) {
        dd('Erreur token:', $response->json());
    }

    $token = $response->json();
    session(['spotify_token' => $token['access_token']]);

    // Rediriger vers la page de test
    return redirect('/spotify-test')->with('success', 'Token récupéré !');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';