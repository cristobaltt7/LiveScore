<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlayerController extends Controller
{
    // URL base de la API de Transfermarkt
    protected $base = 'https://transfermarkt-api.fly.dev';

    // Muestra la plantilla de jugadores de un club según su ID
    public function index($clubId)
    {
        $response = Http::get("https://transfermarkt-api.fly.dev/clubs/{$clubId}/players");

        if ($response->successful()) {
            $playersRaw = $response->json()['players'] ?? [];

            // Mapea solo los datos necesarios, sin la imagen
            $players = array_map(function ($player) {
                return [
                    'id' => $player['id'] ?? null,
                    'name' => $player['name'] ?? 'Desconocido',
                ];
            }, $playersRaw);

            return view('players.index', compact('players'));
        }

        return back()->withErrors(['error' => 'No se pudo obtener la plantilla del club.']);
    }

    // Muestra el perfil básico de un jugador usando su ID
    public function profile($playerId)
    {
        try {
            $response = Http::timeout(10)->get("https://transfermarkt-api.fly.dev/players/{$playerId}/profile");

            if ($response->successful()) {
                $player = $response->json();
                return view('player-statistics.full-profile', compact('player'));
            }

            // Si la respuesta no es exitosa
            return view('player-statistics.api-error', [
                'message' => 'En estos momentos la API está dando problemas. Inténtalo más tarde.'
            ]);

        } catch (\Exception $e) {
            return view('player-statistics.api-error', [
                'message' => 'En estos momentos la API está dando problemas. Inténtalo más tarde.'
            ]);
        }
    }

    // Muestra el perfil completo de un jugador: perfil, estadísticas, lesiones y logros
    public function fullProfile($playerId)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $profile = json_decode($client->get("https://transfermarkt-api.fly.dev/players/{$playerId}/profile")->getBody(), true);
            $stats = json_decode($client->get("https://transfermarkt-api.fly.dev/players/{$playerId}/stats")->getBody(), true);
            $injuries = json_decode($client->get("https://transfermarkt-api.fly.dev/players/{$playerId}/injuries")->getBody(), true);
            $achievements = json_decode($client->get("https://transfermarkt-api.fly.dev/players/{$playerId}/achievements")->getBody(), true);

            return view('players.full-profile', compact('profile', 'stats', 'injuries', 'achievements'))
                ->with('error', null);

        } catch (\Exception $e) {
            // Puedes registrar el error si lo deseas: Log::error($e->getMessage());
            return view('players.full-profile')
                ->with('error', 'La API no está disponible en estos momentos.')
                ->with('profile', [])
                ->with('stats', [])
                ->with('injuries', [])
                ->with('achievements', []);
        }
    }

    // Muestra todos los clubes disponibles
    public function showAllClubs()
    {
        $clubs = [
            ['id' => 418, 'name' => 'Real Madrid', 'logo' => 'https://crests.football-data.org/86.png'],
            ['id' => 131, 'name' => 'FC Barcelona', 'logo' => 'https://crests.football-data.org/81.png'],
            ['id' => 13, 'name' => 'Atlético de Madrid', 'logo' => 'https://crests.football-data.org/78.png'],
            ['id' => 621, 'name' => 'Athletic Club', 'logo' => 'https://crests.football-data.org/77.png'],
            ['id' => 681, 'name' => 'Real Sociedad', 'logo' => 'https://crests.football-data.org/92.png'],
            ['id' => 1050, 'name' => 'Villarreal CF', 'logo' => 'https://crests.football-data.org/94.png'],
            ['id' => 1049, 'name' => 'Valencia CF', 'logo' => 'https://crests.football-data.org/95.png'],
            ['id' => 12321, 'name' => 'Girona FC', 'logo' => 'https://crests.football-data.org/298.png'],
            ['id' => 150, 'name' => 'Real Betis Balompié', 'logo' => 'https://crests.football-data.org/90.png'],
            ['id' => 368, 'name' => 'Sevilla FC', 'logo' => 'https://crests.football-data.org/559.png'],
            ['id' => 940, 'name' => 'RC Celta', 'logo' => 'https://crests.football-data.org/558.png'],
            ['id' => 3709, 'name' => 'Getafe CF', 'logo' => 'https://crests.football-data.org/82.png'],
            ['id' => 472, 'name' => 'UD Las Palmas', 'logo' => 'https://crests.football-data.org/275.png'],
            ['id' => 367, 'name' => 'Rayo Vallecano', 'logo' => 'https://crests.football-data.org/87.png'],
            ['id' => 331, 'name' => 'CA Osasuna', 'logo' => 'https://crests.football-data.org/79.png'],
            ['id' => 237, 'name' => 'RCD Mallorca', 'logo' => 'https://crests.football-data.org/89.png'],
            ['id' => 1108, 'name' => 'Deportivo Alavés', 'logo' => 'https://crests.football-data.org/263.png'],
            ['id' => 1244, 'name' => 'CD Leganés', 'logo' => 'https://crests.football-data.org/745.png'],
            ['id' => 366, 'name' => 'Real Valladolid', 'logo' => 'https://crests.football-data.org/250.png'],
            ['id' => 714, 'name' => 'RCD Espanyol', 'logo' => 'https://crests.football-data.org/80.png'],
        ];

        return view('player-statistics.index', compact('clubs'));
    }
}