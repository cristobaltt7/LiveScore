<?php

namespace App\Http\Controllers;
use App\Models\Squad;
use App\Models\FavoriteTeam;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FootballController extends Controller
{
    public function home()
    {
        try {
            $apiToken = env('FOOTBALL_DATA_API_TOKEN');

            if (empty($apiToken)) {
                throw new \Exception('API token no configurado en .env');
            }

            $competitionCode = 'PD';

            $matchesResponse = Http::withHeaders([
                'X-Auth-Token' => $apiToken
            ])->get("https://api.football-data.org/v4/competitions/{$competitionCode}/matches");

            if ($matchesResponse->failed()) {
                throw new \Exception('Error al obtener partidos: ' . $matchesResponse->status());
            }

            $matchesData = $matchesResponse->json();

            $finishedMatches = array_filter($matchesData['matches'] ?? [], function ($match) {
                return $match['status'] === 'FINISHED';
            });
            usort($finishedMatches, fn($a, $b) => strtotime($b['utcDate']) <=> strtotime($a['utcDate']));
            $fixtures = array_slice($finishedMatches, 0, 5);

            $standingsResponse = Http::withHeaders([
                'X-Auth-Token' => $apiToken
            ])->get("https://api.football-data.org/v4/competitions/{$competitionCode}/standings");

            if ($standingsResponse->failed()) {
                throw new \Exception('Error al obtener clasificación: ' . $standingsResponse->status());
            }

            $standingsData = $standingsResponse->json();

            $standings = $standingsData['standings'][0]['table'] ?? [];

            return view('home', [
                'fixtures' => $this->formatFixtures($fixtures),
                'standings' => $this->formatStandings($standings),
                'apiError' => false
            ]);
        } catch (\Exception $e) {
            return view('home', [
                'fixtures' => [],
                'standings' => [],
                'apiError' => $e->getMessage()
            ]);
        }
    }

    private function formatFixtures($fixtures)
    {
        return array_map(function ($fixture) {
            return [
                'homeTeam' => [
                    'name' => $fixture['homeTeam']['name'] ?? 'Local',
                    'image' => ''
                ],
                'awayTeam' => [
                    'name' => $fixture['awayTeam']['name'] ?? 'Visitante',
                    'image' => ''
                ],
                'scores' => [
                    'home_score' => $fixture['score']['fullTime']['home'] ?? 0,
                    'away_score' => $fixture['score']['fullTime']['away'] ?? 0
                ]
            ];
        }, $fixtures);
    }

    private function formatStandings($standings)
    {
        return array_map(function ($team) {
            return [
                'position' => $team['position'] ?? 0,
                'team' => [
                    'name' => $team['team']['name'] ?? 'Equipo',
                    'image' => ''
                ],
                'points' => $team['points'] ?? 0,
                'overall' => [
                    'games_played' => $team['playedGames'] ?? 0,
                    'won' => $team['won'] ?? 0,
                    'draw' => $team['draw'] ?? 0,
                    'lost' => $team['lost'] ?? 0,
                    'goals_scored' => $team['goalsFor'] ?? 0,
                    'goals_against' => $team['goalsAgainst'] ?? 0
                ]
            ];
        }, $standings);
    }
    public function search(Request $request)
{
    $query = $request->query('query');
    if (!$query) return response()->json([]);

    $response = Http::withHeaders([
        'X-Auth-Token' => env('FOOTBALL_DATA_API_TOKEN')
    ])->get("https://api.football-data.org/v4/teams?name=" . urlencode($query));

    if ($response->failed()) return response()->json([]);

    return response()->json($response->json()['teams'] ?? []);
}


  public function index()
    {
        try {
            $apiToken = env('FOOTBALL_DATA_API_TOKEN');

            $response = Http::withHeaders([
                'X-Auth-Token' => $apiToken
            ])->get("https://api.football-data.org/v4/competitions/PD/teams");

            if ($response->failed()) {
                throw new \Exception('Error al cargar equipos');
            }

            $teams = $response->json()['teams'] ?? [];

            $clubIdMap = [
                81 => 131,     // FC Barcelona
                86 => 418,     // Real Madrid
                78 => 13,      // Atlético de Madrid
                559 => 368,    // Sevilla FC
                92 => 681,     // Real Sociedad
                95 => 1049,    // Valencia CF
                94 => 1050,    // Villarreal CF
                90 => 150,     // Real Betis
                77 => 621,     // Athletic Club
                82 => 3709,    // Getafe CF
                298 => 12321,  // Girona FC
                87 => 367,     // Rayo Vallecano
                250 => 366,    // Real Valladolid
                745 => 1244,   // CD Leganés
                275 => 472,    // UD Las Palmas
                89 => 237,     // RCD Mallorca
                80 => 714,     // RCD Espanyol
                263 => 1108,   // Deportivo Alavés
                558 => 940,    // Celta de Vigo
                79 => 331      // Osasuna
            ];

            foreach ($teams as &$team) {
                $team['club_id'] = $clubIdMap[$team['id']] ?? null;
            }
$favoritos = array_keys(json_decode(auth()->user()->favorite_teams ?? '{}', true));


return view('football', [
    'teams' => $teams,
    'favoritos' => $favoritos
]);


        } catch (\Exception $e) {
            return view('football', [
                'teams' => [],
                'error' => $e->getMessage()
            ]);
        }
    }



public function availableLeagues()
{
    $apiToken = env('FOOTBALL_DATA_API_TOKEN');
    $response = Http::withHeaders([
        'X-Auth-Token' => $apiToken
    ])->get('https://api.football-data.org/v4/competitions');

    $competitions = collect($response->json('competitions'))
        ->filter(fn($c) => $c['plan'] === 'TIER_ONE') // Solo ligas principales
        ->map(fn($c) => [
            'code' => $c['code'],
            'name' => $c['name']
        ])
        ->values();

    return response()->json($competitions);
}
public function getSquad($id)
{
    $players = Squad::where('team_id', $id)->get();
    return response()->json($players);
}


public function teamDetails($id)
{
    // Mapeo Football-Data ID => Transfermarkt club_id
    $clubIdMap = [
        81 => 131, 86 => 418, 78 => 13, 559 => 368, 92 => 681,
        95 => 1049, 94 => 1050, 90 => 150, 77 => 621, 82 => 3709,
        298 => 12321, 87 => 367, 250 => 366, 745 => 1244, 275 => 472,
        89 => 237, 80 => 714, 263 => 1108, 558 => 940, 79 => 331
    ];

    $clubId = $clubIdMap[$id] ?? null;

    if (!$clubId) {
        return response()->json(['error' => 'Club ID no mapeado'], 404);
    }

    $response = Http::get("https://transfermarkt-api.fly.dev/clubs/{$clubId}/profile");

    if ($response->failed()) {
        return response()->json(['error' => 'No se pudo obtener el perfil del club'], 500);
    }

    $data = $response->json();

    return response()->json([
        'team' => [
            'id' => $id,
            'name' => $data['name'] ?? 'Desconocido',
            'logo' => $data['image'] ?? '',
            'country' => $data['addressLine3'] ?? 'Desconocido',
            'founded' => isset($data['foundedOn']) ? substr($data['foundedOn'], 0, 4) : 'Desconocido'
        ],
        'venue' => [
            'name' => $data['stadiumName'] ?? 'Desconocido',
            'capacity' => $data['stadiumSeats'] ?? 0
        ],
        'statistics' => null
    ]);
}



public function getTeamSquad($teamId)
{
    try {
        // Primero obtenemos los detalles básicos del equipo de football-data
        $teamResponse = Http::withHeaders([
            'X-Auth-Token' => env('FOOTBALL_DATA_API_TOKEN')
        ])->get("https://api.football-data.org/v4/teams/{$teamId}");

        $teamData = $teamResponse->successful() ? $teamResponse->json() : [];
        
        // Ahora obtenemos la plantilla de Transfermarkt API
        $transfermarktResponse = Http::get("https://transfermarkt-api.fly.dev/clubs/{$teamId}/players");
        
        if ($transfermarktResponse->failed()) {
            throw new \Exception('Error al obtener la plantilla del equipo');
        }

        $squadData = $transfermarktResponse->json();
        
        // Organizar jugadores por posición
        $squad = [
            'goalkeepers' => [],
            'defenders' => [],
            'midfielders' => [],
            'forwards' => []
        ];

        foreach ($squadData['players'] ?? [] as $player) {
            $position = strtolower($player['position'] ?? '');
            
            if (str_contains($position, 'goalkeeper')) {
                $squad['goalkeepers'][] = $player;
            } elseif (str_contains($position, 'back') || str_contains($position, 'defender')) {
                $squad['defenders'][] = $player;
            } elseif (str_contains($position, 'midfield')) {
                $squad['midfielders'][] = $player;
            } else {
                $squad['forwards'][] = $player;
            }
        }

        return response()->json([
            'team' => [
                'name' => $teamData['name'] ?? $squadData['club']['name'] ?? 'Desconocido',
                'crest' => $teamData['crest'] ?? null
            ],
            'squad' => $squad
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


public function getTransfermarktSquad($clubId)
{
    $response = Http::get("https://transfermarkt-api.fly.dev/clubs/{$clubId}/players");

    if ($response->successful()) {
        return response()->json($response->json());
    }

    return response()->json([
        'error' => 'No se pudo obtener la plantilla',
        'status' => $response->status(),
        'body' => $response->body()
    ], $response->status());
}

public function resultados(Request $request)
{
    $apiToken = env('FOOTBALL_DATA_API_TOKEN');
    $jornada = $request->query('jornada'); // ej: 1, 2, 3...

    // Obtener resultados de partidos
    $matchesUrl = "https://api.football-data.org/v4/competitions/PD/matches";
    if ($jornada) {
        $matchesUrl .= "?matchday=$jornada";
    }

    $matchesResponse = Http::withHeaders([
        'X-Auth-Token' => $apiToken
    ])->get($matchesUrl);

    $matches = $matchesResponse->successful()
        ? ($matchesResponse->json()['matches'] ?? [])
        : [];

    // Obtener clasificación
    $standingsResponse = Http::withHeaders([
        'X-Auth-Token' => $apiToken
    ])->get("https://api.football-data.org/v4/competitions/PD/standings");

    $standings = $standingsResponse->successful()
        ? ($standingsResponse->json()['standings'][0]['table'] ?? [])
        : [];

    // Obtener máximos goleadores (scorers)
    $scorersResponse = Http::withHeaders([
        'X-Auth-Token' => $apiToken
    ])->get("https://api.football-data.org/v4/competitions/PD/scorers");

    $scorers = $scorersResponse->successful()
        ? ($scorersResponse->json()['scorers'] ?? [])
        : [];

    return view('liga.resultados', compact('matches', 'standings', 'jornada', 'scorers'));
}


public function verClub($id)
{
    $url = "https://transfermarkt-api.fly.dev/clubs/{$id}/profile";

    $response = Http::get($url);

    if ($response->successful()) {
        $data = $response->json();
        return view('club-info', ['data' => $data]);
    }

    return redirect()->route('favorites')->with('error', 'No se pudo cargar la información del club.');
}


}