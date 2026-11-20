<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Interesse;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $usuarios = [
        ['Jorge Batista', 'jorge@prosa.com', '1955-03-12', 'São Paulo', 'Pedreiro aposentado', 'Pescar e jogar bola', 'Já trabalhei como pedreiro por mais de 30 anos. Tenho 3 filhos e 5 netos que são meu orgulho. Gosto de conversar, contar histórias e conhecer pessoas novas.', true],
        ['Maria das Dores', 'maria@prosa.com', '1952-07-25', 'Campinas', 'Professora aposentada', 'Bordado', 'Ensinei por 35 anos e adoro uma boa conversa com um café.', false],
        ['Antônio Carlos', 'antonio@prosa.com', '1949-11-02', 'Santos', 'Marinheiro aposentado', 'Pesca', 'Passei a vida no mar e agora quero companhia para pescar.', false],
        ['Helena Souza', 'helena@prosa.com', '1957-01-30', 'São Paulo', 'Costureira', 'Jardinagem', 'Cuido de um jardim cheio de flores e gosto de trocar mudas.', false],
        ['José Ribeiro', 'jose@prosa.com', '1950-05-18', 'Guarulhos', 'Motorista', 'Futebol', 'Corinthiano de carteirinha. Vai Corinthians!', false],
        ['Teresa Lima', 'teresa@prosa.com', '1954-09-09', 'Osasco', 'Cozinheira', 'Culinária', 'Faço o melhor bolo de fubá da região.', false],
        ['Raimundo Nunes', 'raimundo@prosa.com', '1948-12-21', 'Santo André', 'Comerciante', 'Dominó', 'Tenho uma boa prosa e um baralho sempre à mão.', false],
        ['Aparecida Faria', 'aparecida@prosa.com', '1956-04-14', 'Sorocaba', 'Enfermeira', 'Dança', 'Adoro um forró e uma roda de amigos.', false],
        ['Sebastião Melo', 'sebastiao@prosa.com', '1951-08-03', 'Jundiaí', 'Agricultor', 'Violão', 'Toco violão desde os 15 anos e adoro cantar modas de viola.', false],
        ['Luzia Prado', 'luzia@prosa.com', '1953-02-27', 'São Paulo', 'Secretária', 'Leitura', 'Leio um livro por semana e adoro comentar histórias.', false],
    ];

    foreach ($usuarios as [$nome, $email, $nasc, $cidade, $prof, $passa, $sobre, $admin]) {
        $user = User::create([
            'name' => $nome,
            'email' => $email,
            'password' => Hash::make('senha123'),
            'data_nascimento' => $nasc,
            'cidade' => $cidade,
            'profissao' => $prof,
            'passatempo' => $passa,
            'sobre' => $sobre,
            'onboarding_completo' => true,
            'is_admin' => $admin,
        ]);

        $user->interesses()->attach(
            Interesse::inRandomOrder()->take(3)->pluck('id')
        );
    }
}
}
