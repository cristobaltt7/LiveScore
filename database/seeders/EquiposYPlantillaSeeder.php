<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposYPlantillaSeeder extends Seeder
{
    public function run()
    {
        $equipos = [
            ['nombre' => 'Real Madrid', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/5/56/Real_Madrid_CF.svg'],
            ['nombre' => 'FC Barcelona', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/4/47/FC_Barcelona_%28crest%29.svg'],
            ['nombre' => 'Atlético de Madrid', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/f/f4/Atletico_Madrid_2017_logo.svg'],
            ['nombre' => 'Sevilla FC', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/f/f6/Sevilla_FC_logo.svg'],
            ['nombre' => 'Real Sociedad', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/4/4f/Real_Sociedad_logo.svg'],
            ['nombre' => 'Athletic Club', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/1/19/Athletic_Bilbao_logo.svg'],
            ['nombre' => 'Real Betis', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/3/3f/Real_Betis_logo.svg'],
            ['nombre' => 'Villarreal CF', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/7/75/Villarreal_CF_logo.svg'],
            ['nombre' => 'Valencia CF', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/c/c6/Valencia_CF_logo.svg'],
            ['nombre' => 'Celta de Vigo', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/3/3a/RC_Celta_de_Vigo_logo.svg'],
            ['nombre' => 'Getafe CF', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/9/98/Getafe_CF_logo.svg'],
            ['nombre' => 'CA Osasuna', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/9/90/CA_Osasuna_logo.svg'],
            ['nombre' => 'Rayo Vallecano', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/f/fd/Rayo_Vallecano_logo.svg'],
            ['nombre' => 'UD Las Palmas', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/8/87/UD_Las_Palmas_logo.svg'],
            ['nombre' => 'Valladolid FC', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/0/09/Real_Valladolid_logo.svg'],
            ['nombre' => 'RCD Mallorca', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/f/f4/RCD_Mallorca_logo.svg'],
            ['nombre' => 'Deportivo Alavés', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/1/1b/Deportivo_Alavés_logo.svg'],
            ['nombre' => 'CD Leganés', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/0/0c/CD_Leganés_logo.svg'],
            ['nombre' => 'Girona FC', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/e/ed/Girona_FC_logo.svg'],
            ['nombre' => 'RCD Espanyol', 'escudo_url' => 'https://upload.wikimedia.org/wikipedia/en/5/5a/RCD_Espanyol_logo.svg'],
        ];

        // Insertar equipos y sus plantillas
        foreach ($equipos as $equipo) {
            $equipoId = DB::table('equipos')->insertGetId([
                'nombre' => $equipo['nombre'],
                'escudo_url' => $equipo['escudo_url'],
                'deporte' => 'futbol',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Plantilla genérica con 3 jugadores (puedes personalizar más)
            $jugadores = [];

            switch ($equipo['nombre']) {
                case 'Real Madrid':
                    $jugadores = [
                        ['nombre_jugador' => 'Thibaut Courtois', 'posicion' => 'Portero', 'edad' => 33, 'nacionalidad' => 'Bélgica'],
                        ['nombre_jugador' => 'Kylian Mbappé', 'posicion' => 'Delantero', 'edad' => 26, 'nacionalidad' => 'Francia'],
                        ['nombre_jugador' => 'Luka Modrić', 'posicion' => 'Centrocampista', 'edad' => 39, 'nacionalidad' => 'Croacia'],
                    ];
                    break;

                case 'FC Barcelona':
                    $jugadores = [
                        ['nombre_jugador' => 'Marc-André ter Stegen', 'posicion' => 'Portero', 'edad' => 33, 'nacionalidad' => 'Alemania'],
                        ['nombre_jugador' => 'Robert Lewandowski', 'posicion' => 'Delantero', 'edad' => 37, 'nacionalidad' => 'Polonia'],
                        ['nombre_jugador' => 'Pedri', 'posicion' => 'Centrocampista', 'edad' => 23, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Atlético de Madrid':
                    $jugadores = [
                        ['nombre_jugador' => 'Jan Oblak', 'posicion' => 'Portero', 'edad' => 32, 'nacionalidad' => 'Eslovenia'],
                        ['nombre_jugador' => 'Marcos Llorente', 'posicion' => 'Centrocampista', 'edad' => 30, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Koke', 'posicion' => 'Centrocampista', 'edad' => 33, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Sevilla FC':
                    $jugadores = [
                        ['nombre_jugador' => 'Álvaro Fernández', 'posicion' => 'Portero', 'edad' => 27, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Loic Bade', 'posicion' => 'Defensa', 'edad' => 25, 'nacionalidad' => 'Francia'],
                        ['nombre_jugador' => 'Suso', 'posicion' => 'Centrocampista', 'edad' => 31, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Real Sociedad':
                    $jugadores = [
                        ['nombre_jugador' => 'Álex Remiro', 'posicion' => 'Portero', 'edad' => 31, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Mikel Oyarzabal', 'posicion' => 'Delantero', 'edad' => 28, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Martín Zubimendi ', 'posicion' => 'Centrocampista', 'edad' => 26, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Athletic Club':
                    $jugadores = [
                        ['nombre_jugador' => 'Unai Simón', 'posicion' => 'Portero', 'edad' => 28, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Nico Williams', 'posicion' => 'Delantero', 'edad' => 22, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Iñaki Williams', 'posicion' => 'Delantero', 'edad' => 31, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Real Betis':
                    $jugadores = [
                        ['nombre_jugador' => 'Isco', 'posicion' => 'Centrocampista', 'edad' => 33, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Antony', 'posicion' => 'Delantero', 'edad' => 25, 'nacionalidad' => 'Brasil'],
                        ['nombre_jugador' => 'Pablo Fornals', 'posicion' => 'Centrocampista', 'edad' => 29, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Villarreal CF':
                    $jugadores = [
                        ['nombre_jugador' => 'Dani Parejo ', 'posicion' => 'Centrocampista', 'edad' => 36, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Yeremy Pino', 'posicion' => 'Delantero', 'edad' => 22, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Gerard Moreno', 'posicion' => 'Delantero', 'edad' => 33, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Valencia CF':
                    $jugadores = [
                        ['nombre_jugador' => 'André Almeida', 'posicion' => 'Centrocampista', 'edad' => 24, 'nacionalidad' => 'Portugal'],
                        ['nombre_jugador' => 'José Gayà', 'posicion' => 'Defensa', 'edad' => 30, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Hugo Duro', 'posicion' => 'Delantero', 'edad' => 26, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Celta de Vigo':
                    $jugadores = [
                        ['nombre_jugador' => 'Franco Cervi', 'posicion' => 'Centrocampista', 'edad' => 37, 'nacionalidad' => 'Argentina'],
                        ['nombre_jugador' => 'Iago Aspas', 'posicion' => 'Delantero', 'edad' => 37, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Fran Beltrán', 'posicion' => 'Centrocampista', 'edad' => 26, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Getafe CF':
                    $jugadores = [
                        ['nombre_jugador' => 'David Soria', 'posicion' => 'Portero', 'edad' => 32, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Borja Mayoral', 'posicion' => 'Delantero', 'edad' => 28, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Juan Bernat', 'posicion' => 'Defensa', 'edad' => 32, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'CA Osasuna':
                    $jugadores = [
                        ['nombre_jugador' => 'Sergio Herrera', 'posicion' => 'Portero', 'edad' => 31, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Bryan Zaragoza', 'posicion' => 'Delantero', 'edad' => 23, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Iker Muñoz', 'posicion' => 'Centrocampista', 'edad' => 22, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Rayo Vallecano':
                    $jugadores = [
                        ['nombre_jugador' => 'Dani Cárdenas', 'posicion' => 'Portero', 'edad' => 28, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Raúl De Tomas', 'posicion' => 'Delantero', 'edad' => 30, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Óscar Trejo', 'posicion' => 'Centrocampista', 'edad' => 37, 'nacionalidad' => 'Argentina'],
                    ];
                    break;

                case 'UD Las Palmas':
                    $jugadores = [
                        ['nombre_jugador' => 'Jasper Cillessen', 'posicion' => 'Portero', 'edad' => 36, 'nacionalidad' => 'Países Bajos'],
                        ['nombre_jugador' => 'Sandro Ramírez', 'posicion' => 'Delantero', 'edad' => 29, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Kirian Rodriguez', 'posicion' => 'Centrocampista', 'edad' => 29, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Valladolid FC':
                    $jugadores = [
                        ['nombre_jugador' => 'Arnau Rafús', 'posicion' => 'Portero', 'edad' => 22, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Mario Martín', 'posicion' => 'Centrocampista', 'edad' => 21, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Chuky', 'posicion' => 'Centrocampista', 'edad' => 21, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'RCD Mallorca':
                    $jugadores = [
                        ['nombre_jugador' => 'Iván Cuellar', 'posicion' => 'Portero', 'edad' => 40, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Sergi darder', 'posicion' => 'Centrocampista', 'edad' => 31, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Abdón', 'posicion' => 'Delantero', 'edad' => 32, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Deportivo Alavés':
                    $jugadores = [
                        ['nombre_jugador' => 'Antonio Sivera', 'posicion' => 'Portero', 'edad' => 28, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Kike', 'posicion' => 'Delantero', 'edad' => 35, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Joan Jordan', 'posicion' => 'Centrocampista', 'edad' => 30, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'CD Leganés':
                    $jugadores = [
                        ['nombre_jugador' => 'Juan Soriano', 'posicion' => 'Portero', 'edad' => 27, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Óscar', 'posicion' => 'Centrocampista', 'edad' => 26, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Daniel Raba', 'posicion' => 'Delantero', 'edad' => 29, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'Girona FC':
                    $jugadores = [
                        ['nombre_jugador' => 'Juan Carlos', 'posicion' => 'Portero', 'edad' => 37, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Stuani', 'posicion' => 'Delantero', 'edad' => 38, 'nacionalidad' => 'Uruguay'],
                        ['nombre_jugador' => 'Miguel Gutiérrez', 'posicion' => 'Defensa', 'edad' => 23, 'nacionalidad' => 'España'],
                    ];
                    break;

                case 'RCD Espanyol':
                    $jugadores = [
                        ['nombre_jugador' => 'Joan García', 'posicion' => 'Portero', 'edad' => 24, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Javi Puado', 'posicion' => 'Delantero', 'edad' => 27, 'nacionalidad' => 'España'],
                        ['nombre_jugador' => 'Pere Milla', 'posicion' => 'Centrocampista', 'edad' => 32, 'nacionalidad' => 'España'],
                    ];
                    break;
            }

            foreach ($jugadores as $jugador) {
                DB::table('jugadores')->insert([
                    'nombre' => $jugador['nombre_jugador'],
                    'posicion' => $jugador['posicion'],
                    'edad' => $jugador['edad'],
                    'nacionalidad' => $jugador['nacionalidad'],
                    'equipos_id' => $equipoId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
