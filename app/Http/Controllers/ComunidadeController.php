<?php

namespace App\Http\Controllers;

use App\Models\Comunidade;
use Illuminate\Http\Request;

class ComunidadeController extends Controller
{
    private function regras(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string', 'max:1000'],
        ];
    }

    // Só o criador (ou um admin) pode editar/excluir
    private function autorizar(Comunidade $comunidade): void
    {
        abort_unless(
            auth()->id() === $comunidade->user_id || auth()->user()->is_admin,
            403
        );
    }

    public function index()
    {
        $comunidades = Comunidade::with('criador')
            ->withCount('membros')
            ->orderBy('nome')
            ->paginate(9);

        return view('comunidades.index', compact('comunidades'));
    }

    public function create()
    {
        return view('comunidades.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate($this->regras());

        $comunidade = Comunidade::create($dados + ['user_id' => $request->user()->id]);
        $comunidade->membros()->attach($request->user()->id);

        return redirect()->route('comunidades.show', $comunidade)
            ->with('sucesso', 'Comunidade criada com sucesso!');
    }

    public function show(Comunidade $comunidade)
    {
        $comunidade->load('criador', 'membros', 'eventos');

        return view('comunidades.show', compact('comunidade'));
    }

    public function edit(Comunidade $comunidade)
    {
        $this->autorizar($comunidade);

        return view('comunidades.edit', compact('comunidade'));
    }

    public function update(Request $request, Comunidade $comunidade)
    {
        $this->autorizar($comunidade);
        $comunidade->update($request->validate($this->regras()));

        return redirect()->route('comunidades.show', $comunidade)
            ->with('sucesso', 'Comunidade atualizada!');
    }

    public function destroy(Comunidade $comunidade)
    {
        $this->autorizar($comunidade);
        $comunidade->delete();

        return redirect()->route('comunidades.index')->with('sucesso', 'Comunidade excluída.');
    }

    public function entrar(Request $request, Comunidade $comunidade)
    {
        $comunidade->membros()->syncWithoutDetaching([$request->user()->id]);

        return back()->with('sucesso', 'Você entrou na comunidade!');
    }

    public function sair(Request $request, Comunidade $comunidade)
    {
        $comunidade->membros()->detach($request->user()->id);

        return back()->with('sucesso', 'Você saiu da comunidade.');
    }
}