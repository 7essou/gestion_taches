<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            // Admin view - show all tasks
            $taches = Tache::all();
            $stats = [
                'total' => $taches->count(),
                'start' => $taches->where('etat', 'start')->count(),
                'progress' => $taches->where('etat', 'progress')->count(),
                'done' => $taches->where('etat', 'dane')->count(),
                'upcoming' => $taches->where('dateDebut', '>', now())->count(),
                'overdue' => $taches->where('datefin', '<', now())->where('etat', '!=', 'dane')->count(),
            ];
        } else {
            // Employer view - show only their tasks
            $taches = Tache::where('user_id', $user->id)->get();
            $stats = [
                'total' => $taches->count(),
                'start' => $taches->where('etat', 'start')->count(),
                'progress' => $taches->where('etat', 'progress')->count(),
                'done' => $taches->where('etat', 'dane')->count(),
                'upcoming' => $taches->where('dateDebut', '>', now())->count(),
                'overdue' => $taches->where('datefin', '<', now())->where('etat', '!=', 'dane')->count(),
            ];
        }

        return view('Home', compact('stats', 'user', 'taches'));
    }
} 