<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposSeeder extends Seeder
{
    public function run(): void
    {
        $equipos = [
            'Real Madrid',
            'FC Barcelona',
            'Atlético de Madrid',
            'Sevilla FC',
            'Real Sociedad',
            'Athletic Club',
            'Real Betis',
            'Villarreal CF',
            'Valencia CF',
            'Celta de Vigo',
            'Getafe CF',
            'CA Osasuna',
            'Rayo Vallecano',
            'UD Las Palmas',
            'Valladolid FC',
            'RCD Mallorca',
            'Deportivo Alavés',
            'CD Leganés',
            'Girona FC',
            'RCD Espanyol',
        ];

        foreach ($equipos as $nombre) {
            DB::table('equipos')->insert([
                'nombre' => $nombre,
                'escudo_url' => null, // Puedes luego actualizar con las URLs
                'deporte' => 'futbol',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
