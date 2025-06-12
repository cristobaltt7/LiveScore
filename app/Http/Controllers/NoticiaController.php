<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoticiaController extends Controller
{

    // Muestra la vista principal de noticias (noticias.blade.php)
    public function index()
    {
        return view('noticias');
    }

    // Método para obtener noticias automáticamente, rotando consultas en cada página
    public function fetch(Request $request)
    {
        $apiKey = 'ea4e1d5ab7d64ede59c27928015e65b3';
        $page = $request->input('page', 1);

        $queries = [
            'fútbol español',
            'LaLiga',
            'Primera División España',
            'Real Madrid fútbol',
            'Barcelona fútbol',
            'fútbol selecciones España',
            'liga española fútbol',
            'resultados LaLiga',
            'noticias fútbol España',
        ];

        $query = $queries[($page - 1) % count($queries)];

        $url = "https://gnews.io/api/v4/search?q=" . urlencode($query) . "&lang=es&country=es&max=6&page=1&apikey={$apiKey}";

        $response = Http::get($url);

        if ($response->successful()) {
            $articles = $response->json()['articles'] ?? [];
            return response()->json(['articles' => $articles]);
        }

        return response()->json(['articles' => []], 500);
    }

    // Método para buscar noticias según término introducido por el usuario
    public function search(Request $request)
    {
        $apiKey = 'ea4e1d5ab7d64ede59c27928015e65b3';
        $term = $request->query('q');

        if (!$term) {
            return response()->json(['articles' => []], 400);
        }

        $url = "https://gnews.io/api/v4/search?q=" . urlencode($term) . "&lang=es&country=es&max=6&page=1&apikey={$apiKey}";

        $response = Http::get($url);

        if ($response->successful()) {
            $articles = $response->json()['articles'] ?? [];
            return response()->json(['articles' => $articles]);
        }

        return response()->json(['articles' => []], 500);
    }
}