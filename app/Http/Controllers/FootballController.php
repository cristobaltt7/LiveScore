<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

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
}
