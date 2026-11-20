<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comunidade;
use App\Models\User;

class ComunidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $comunidades = [
        ['Pescadores da Terceira Idade', 'Dicas, histórias e combinados de pescaria.'],
        ['Clube do Bolo e do Café', 'Receitas e conversas na hora do café.'],
        ['Roda de Violão', 'Para quem gosta de cantar e tocar.'],
        ['Jardim Compartilhado', 'Troca de mudas e dicas de jardinagem.'],
        ['Torcedores de Coração', 'Futebol, resenha e muita paixão.'],
        ['Leitores de Plantão', 'Indicações e comentários de livros.'],
        ['Baile da Saudade', 'Quem ama dançar e relembrar os bons tempos.'],
        ['Netos e Orgulho', 'Para quem tem muito a contar sobre a família.'],
        ['Caminhada Saudável', 'Caminhadas em grupo pela manhã.'],
        ['Artesanato e Crochê', 'Trabalhos manuais e dicas de artesanato.'],
    ];

    foreach ($comunidades as [$nome, $descricao]) {
        $c = Comunidade::create([
            'nome' => $nome,
            'descricao' => $descricao,
            'user_id' => User::inRandomOrder()->first()->id,
        ]);

        $c->membros()->attach(User::inRandomOrder()->take(4)->pluck('id'));
    }
}
}
