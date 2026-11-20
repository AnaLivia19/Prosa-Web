<?php

namespace App\Http\Controllers;

use App\Models\Comunidade;
use App\Models\Evento;
use App\Models\Interesse;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'totais' => [
                'usuarios' => User::count(),
                'comunidades' => Comunidade::count(),
                'eventos' => Evento::count(),
                'interesses' => Interesse::count(),
            ],
            'eventos' => Evento::with('comunidade')
                ->withCount('participantes')
                ->orderBy('data_hora')
                ->take(6)
                ->get(),
            'comunidades' => Comunidade::withCount('membros')
                ->orderByDesc('membros_count')
                ->take(6)
                ->get(),
            'interesses' => Interesse::withCount('users')->orderBy('nome')->get(),
            'pessoas' => User::latest()->take(8)->get(),
        ]);
    }
}