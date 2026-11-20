<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amizade;
use App\Models\User;

class AmizadeSeeder extends Seeder
{
public function run(): void
{
    $jorge = User::where('email', 'jorge@prosa.com')->first();
    $outros = User::where('id', '!=', $jorge->id)->orderBy('id')->take(5)->get();

    // 3 amizades aceitas e 2 pedidos enviados pelo Jorge
    foreach ($outros as $i => $u) {
        Amizade::create([
            'user_id' => $jorge->id,
            'amigo_id' => $u->id,
            'status' => $i < 3 ? 'aceita' : 'pendente',
        ]);
    }

    // 1 pedido recebido pelo Jorge
    $extra = User::where('id', '!=', $jorge->id)->orderBy('id')->skip(5)->first();
    Amizade::create(['user_id' => $extra->id, 'amigo_id' => $jorge->id, 'status' => 'pendente']);
}
}
