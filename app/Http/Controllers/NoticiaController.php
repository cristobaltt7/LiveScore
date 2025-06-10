<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoticiaController extends Controller
{
    public function index()
    {
        return view('noticias'); // esta vista solo tiene el HTML base
    }

public function fetch(Request $request)
{
    $apiKey = 'ea4e1d5ab7d64ede59c27928015e65b3';
    $page = $request->input('page', 1);

    // 🔍 Palabras clave fijas pero variadas, siempre sobre fútbol español
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

    // 🔁 Cada página usa un término diferente, rotando con el número de página
    $query = $queries[($page - 1) % count($queries)];

    $url = "https://gnews.io/api/v4/search?q=" . urlencode($query) . "&lang=es&country=es&max=6&page=1&apikey={$apiKey}";

    $response = Http::get($url);

    if ($response->successful()) {
        $articles = $response->json()['articles'] ?? [];
        return response()->json(['articles' => $articles]);
    }

    return response()->json(['articles' => []], 500);
}

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
