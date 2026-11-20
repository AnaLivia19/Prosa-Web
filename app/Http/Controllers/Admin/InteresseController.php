<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interesse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InteresseController extends Controller
{
    public function index()
    {
        $interesses = Interesse::withCount('users')->orderBy('nome')->get();

        return view('admin.interesses.index', compact('interesses'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:100', 'unique:interesses,nome'],
        ]);

        Interesse::create($dados);

        return redirect()->route('admin.interesses.index')->with('sucesso', 'Interesse criado!');
    }

    public function edit(Interesse $interesse)
    {
        return view('admin.interesses.edit', compact('interesse'));
    }

    public function update(Request $request, Interesse $interesse)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:100', Rule::unique('interesses', 'nome')->ignore($interesse->id)],
        ]);

        $interesse->update($dados);

        return redirect()->route('admin.interesses.index')->with('sucesso', 'Interesse atualizado!');
    }

    public function destroy(Interesse $interesse)
    {
        $interesse->delete();

        return redirect()->route('admin.interesses.index')->with('sucesso', 'Interesse excluído.');
    }
}