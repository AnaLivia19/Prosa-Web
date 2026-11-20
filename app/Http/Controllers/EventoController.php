<?php

namespace App\Http\Controllers;

use App\Models\Comunidade;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    private function regras(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string', 'max:1000'],
            'local' => ['required', 'string', 'max:255'],
            'data_hora' => ['required', 'date'],
            'comunidade_id' => ['nullable', 'exists:comunidades,id'],
        ];
    }

    // Só o organizador (ou um admin) pode editar/excluir
    private function autorizar(Evento $evento): void
    {
        abort_unless(
            auth()->id() === $evento->user_id || auth()->user()->is_admin,
            403
        );
    }

    public function index()
    {
        $eventos = Evento::with('organizador', 'comunidade')
            ->withCount('participantes')
            ->orderBy('data_hora')
            ->paginate(9);

        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('eventos.create', [
            'comunidades' => Comunidade::orderBy('nome')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate($this->regras());

        $evento = Evento::create($dados + ['user_id' => $request->user()->id]);
        $evento->participantes()->attach($request->user()->id);

        return redirect()->route('eventos.show', $evento)->with('sucesso', 'Evento criado com sucesso!');
    }

    public function show(Evento $evento)
    {
        $evento->load('organizador', 'comunidade', 'participantes');

        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        $this->autorizar($evento);

        return view('eventos.edit', [
            'evento' => $evento,
            'comunidades' => Comunidade::orderBy('nome')->get(),
        ]);
    }

    public function update(Request $request, Evento $evento)
    {
        $this->autorizar($evento);
        $evento->update($request->validate($this->regras()));

        return redirect()->route('eventos.show', $evento)->with('sucesso', 'Evento atualizado!');
    }

    public function destroy(Evento $evento)
    {
        $this->autorizar($evento);
        $evento->delete();

        return redirect()->route('eventos.index')->with('sucesso', 'Evento excluído.');
    }

    public function participar(Request $request, Evento $evento)
    {
        $evento->participantes()->syncWithoutDetaching([$request->user()->id]);

        return back()->with('sucesso', 'Presença confirmada!');
    }

    public function sair(Request $request, Evento $evento)
    {
        $evento->participantes()->detach($request->user()->id);

        return back()->with('sucesso', 'Você saiu do evento.');
    }
}