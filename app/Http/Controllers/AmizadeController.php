<?php

namespace App\Http\Controllers;

use App\Models\Amizade;
use App\Models\User;
use Illuminate\Http\Request;

class AmizadeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $amigos = Amizade::with('remetente', 'destinatario')
            ->where('status', 'aceita')
            ->where(fn ($q) => $q->where('user_id', $user->id)->orWhere('amigo_id', $user->id))
            ->get();

        $recebidos = Amizade::with('remetente')
            ->where('amigo_id', $user->id)->where('status', 'pendente')->get();

        $enviados = Amizade::with('destinatario')
            ->where('user_id', $user->id)->where('status', 'pendente')->get();

        return view('amigos.index', compact('amigos', 'recebidos', 'enviados'));
    }

    public function solicitar(Request $request, User $usuario)
    {
        $user = $request->user();
        abort_if($usuario->id === $user->id, 403);

        $existe = Amizade::where(fn ($q) => $q->where('user_id', $user->id)->where('amigo_id', $usuario->id))
            ->orWhere(fn ($q) => $q->where('user_id', $usuario->id)->where('amigo_id', $user->id))
            ->exists();

        if (! $existe) {
            Amizade::create(['user_id' => $user->id, 'amigo_id' => $usuario->id, 'status' => 'pendente']);
        }

        return back()->with('sucesso', 'Pedido de amizade enviado!');
    }

    public function aceitar(Request $request, Amizade $amizade)
    {
        abort_unless($amizade->amigo_id === $request->user()->id, 403);
        $amizade->update(['status' => 'aceita']);

        return back()->with('sucesso', 'Agora vocês são amigos!');
    }

    // Serve para recusar, cancelar um pedido enviado ou desfazer uma amizade
    public function destroy(Request $request, Amizade $amizade)
    {
        $id = $request->user()->id;
        abort_unless($amizade->user_id === $id || $amizade->amigo_id === $id, 403);
        $amizade->delete();

        return back()->with('sucesso', 'Pronto, atualizado.');
    }
}