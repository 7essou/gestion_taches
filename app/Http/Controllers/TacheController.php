<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TacheController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $taches = Tache::with('user')->get();
        } else {
            $taches = Tache::where('user_id', $user->id)->with('user')->get();
        }

        return view('taches.index', compact('taches'));
    }

    public function create()
    {
        $users = User::where('role', 'employer')->get();
        return view('taches.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'dateDebut' => 'required|date',
            'datefin' => 'required|date|after_or_equal:dateDebut',
            'user_id' => 'required|exists:users,id',
        ]);

        Tache::create($validated);

        return redirect()->route('taches.index')
            ->with('success', 'Tâche créée avec succès.');
    }

    public function edit(Tache $tache)
    {
        $users = User::where('role', 'employer')->get();
        return view('taches.edit', compact('tache', 'users'));
    }

    public function update(Request $request, Tache $tache)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'dateDebut' => 'required|date',
            'datefin' => 'required|date|after_or_equal:dateDebut',
            'user_id' => 'required|exists:users,id',
        ]);

        $tache->update($validated);

        return redirect()->route('taches.index')
            ->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy(Tache $tache)
    {
        $tache->delete();

        return redirect()->route('taches.index')
            ->with('success', 'Tâche supprimée avec succès.');
    }

    public function updateEtat(Request $request, Tache $tache)
    {
        $validated = $request->validate([
            'etat' => 'required|in:start,progress,dane'
        ]);

        $tache->update($validated);

        return redirect()->back()
            ->with('success', 'Statut de la tâche mis à jour avec succès.');
    }
}
