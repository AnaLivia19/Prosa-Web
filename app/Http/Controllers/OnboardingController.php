<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interesse;

class OnboardingController extends Controller
{
    public function show(Request $request)
{
    if ($request->user()->onboarding_completo) {
        return redirect()->route('dashboard');
    }

    return view('onboarding.index', [
        'interesses' => Interesse::orderBy('nome')->get(),
    ]);
}

public function store(Request $request)
{
    $dados = $request->validate([
        'cidade' => ['required', 'string', 'max:255'],
        'profissao' => ['required', 'string', 'max:255'],
        'passatempo' => ['required', 'string', 'max:255'],
        'sobre' => ['nullable', 'string', 'max:1000'],
        'interesses' => ['nullable', 'array'],
        'interesses.*' => ['exists:interesses,id'],
    ]);

    $user = $request->user();

    $user->update([
        'cidade' => $dados['cidade'],
        'profissao' => $dados['profissao'],
        'passatempo' => $dados['passatempo'],
        'sobre' => $dados['sobre'] ?? null,
        'onboarding_completo' => true,
    ]);

    $user->interesses()->sync($dados['interesses'] ?? []);

    return redirect()->route('dashboard');
}
}
