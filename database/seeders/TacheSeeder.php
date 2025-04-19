<?php

namespace Database\Seeders;

use App\Models\Tache;
use App\Models\User;
use Illuminate\Database\Seeder;

class TacheSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'hesmed45@gmail.com')->first();

        if ($user) {
            $taches = [
                [
                    'titre' => 'Réunion d\'équipe',
                    'description' => 'Réunion hebdomadaire pour discuter des projets en cours',
                    'dateDebut' => now(),
                    'datefin' => now()->addDays(1),
                    'etat' => 'start'
                ],
                [
                    'titre' => 'Préparation présentation',
                    'description' => 'Préparer la présentation pour le client',
                    'dateDebut' => now()->addDays(1),
                    'datefin' => now()->addDays(3),
                    'etat' => 'progress'
                ],
                [
                    'titre' => 'Rapport mensuel',
                    'description' => 'Rédiger le rapport mensuel des activités',
                    'dateDebut' => now()->addDays(2),
                    'datefin' => now()->addDays(5),
                    'etat' => 'start'
                ],
                [
                    'titre' => 'Formation nouvelle équipe',
                    'description' => 'Former la nouvelle équipe sur les outils internes',
                    'dateDebut' => now()->addDays(3),
                    'datefin' => now()->addDays(7),
                    'etat' => 'progress'
                ],
                [
                    'titre' => 'Revue de code',
                    'description' => 'Réviser le code du nouveau module',
                    'dateDebut' => now()->addDays(4),
                    'datefin' => now()->addDays(6),
                    'etat' => 'dane'
                ]
            ];

            foreach ($taches as $tache) {
                Tache::create([
                    ...$tache,
                    'user_id' => $user->id
                ]);
            }
        }
    }
} 