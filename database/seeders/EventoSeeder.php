<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Evento;
use App\Models\User;
use App\Models\Comunidade;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $eventos = [
        ['Pescaria no Lago', 'Parque Ecológico'],
        ['Tarde do Bolo de Fubá', 'Salão Comunitário'],
        ['Roda de Viola', 'Praça Central'],
        ['Troca de Mudas', 'Jardim Botânico'],
        ['Resenha do Futebol', 'Bar do Seu Zé'],
        ['Clube do Livro', 'Biblioteca Municipal'],
        ['Baile da Saudade', 'Clube Recreativo'],
        ['Almoço em Família', 'Centro de Convivência'],
        ['Caminhada no Parque', 'Parque Ibirapuera'],
        ['Oficina de Crochê', 'Centro de Convivência'],
    ];

    foreach ($eventos as $i => [$titulo, $local]) {
        $e = Evento::create([
            'titulo' => $titulo,
            'descricao' => 'Venha participar e conhecer gente nova!',
            'local' => $local,
            'data_hora' => now()->addDays($i + 3)->setTime(15, 0),
            'user_id' => User::inRandomOrder()->first()->id,
            'comunidade_id' => Comunidade::inRandomOrder()->first()->id,
        ]);

        $e->participantes()->attach(User::inRandomOrder()->take(5)->pluck('id'));
    }
}
}
