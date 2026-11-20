<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interesse;

class InteresseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $nomes = ['Futebol', 'Esporte', 'Pesca', 'Culinária', 'Jardinagem',
              'Música', 'Dança', 'Leitura', 'Artesanato', 'Viagens'];

    foreach ($nomes as $nome) {
        Interesse::create(['nome' => $nome]);
    }
}
}
