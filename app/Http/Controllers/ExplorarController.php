<?php

namespace App\Http\Controllers;

use App\Models\Amizade;
use App\Models\User;
use Illuminate\Http\Request;

class ExplorarController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $meusInteresses = $user->interesses()->pluck('interesses.id');

        $usuarios = User::where('id', '!=', $user->id)
            ->with('interesses')
            ->withCount(['interesses as em_comum' => fn ($q) => $q->whereIn('interesses.id', $meusInteresses)])
            ->when($request->busca, fn ($q, $busca) => $q->where(
                fn ($q) => $q->where('name', 'like', "%{$busca}%")->orWhere('cidade', 'like', "%{$busca}%")
            ))
            ->orderByDesc('em_comum')
            ->orderBy('name')
            ->paginate(9)
            ->withQueryString();

        $relacoes = Amizade::where('user_id', $user->id)->orWhere('amigo_id', $user->id)->get()
            ->keyBy(fn ($a) => $a->user_id === $user->id ? $a->amigo_id : $a->user_id);

        return view('explorar.index', compact('usuarios', 'relacoes'));
    }
}