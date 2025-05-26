<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NoticiasSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('noticias')->insert([
                'titulo' => "Noticia deportiva número $i",
                'contenido' => "Este es el contenido de la noticia número $i. Aquí se detalla lo ocurrido en el evento deportivo.",
                'fecha_publicacion' => Carbon::now()->subDays($i),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
