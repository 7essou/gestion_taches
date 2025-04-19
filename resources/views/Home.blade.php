<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .welcome {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .stat-label {
            color: #6b7280;
            font-size: 0.875rem;
        }
        .stat-total { color: #3b82f6; }
        .stat-start { color: #3b82f6; }
        .stat-progress { color: #f59e0b; }
        .stat-done { color: #10b981; }
        .stat-upcoming { color: #8b5cf6; }
        .stat-overdue { color: #ef4444; }
        .recent-tasks {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .recent-tasks h2 {
            margin-bottom: 1rem;
        }
        .task-list {
            list-style: none;
            padding: 0;
        }
        .task-item {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .task-item:last-child {
            border-bottom: none;
        }
        .task-info {
            flex: 1;
        }
        .task-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        .task-dates {
            font-size: 0.875rem;
            color: #6b7280;
        }
        .task-status {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .status-start {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .status-progress {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-done {
            background-color: #d1fae5;
            color: #065f46;
        }
        .task-assignee {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <x-navbar role="{{ Auth::user()->role }}"></x-navbar>
    
    <div class="container">
        <div class="welcome">
            <h1>Bienvenue, {{ $user->name }}!</h1>
            @if($user->role === 'admin')
                <p>Voici un aperçu global des tâches dans le système.</p>
            @else
                <p>Voici un aperçu de vos tâches et de votre progression.</p>
            @endif
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number stat-total">{{ $stats['total'] }}</div>
                <div class="stat-label">Total des Tâches</div>
            </div>
            <div class="stat-card">
                <div class="stat-number stat-start">{{ $stats['start'] }}</div>
                <div class="stat-label">Tâches à Démarrer</div>
            </div>
            <div class="stat-card">
                <div class="stat-number stat-progress">{{ $stats['progress'] }}</div>
                <div class="stat-label">En Cours</div>
            </div>
            <div class="stat-card">
                <div class="stat-number stat-done">{{ $stats['done'] }}</div>
                <div class="stat-label">Terminées</div>
            </div>
            <div class="stat-card">
                <div class="stat-number stat-upcoming">{{ $stats['upcoming'] }}</div>
                <div class="stat-label">À Venir</div>
            </div>
            <div class="stat-card">
                <div class="stat-number stat-overdue">{{ $stats['overdue'] }}</div>
                <div class="stat-label">En Retard</div>
            </div>
        </div>

        <div class="recent-tasks">
            <h2>@if($user->role === 'admin') Tâches Récentes du Système @else Vos Tâches Récentes @endif</h2>
            <ul class="task-list">
                @foreach($taches->sortByDesc('created_at')->take(5) as $tache)
                    <li class="task-item">
                        <div class="task-info">
                            <div class="task-title">{{ $tache->titre }}</div>
                            <div class="task-dates">
                                Du {{ $tache->dateDebut}} au {{ $tache->datefin}}
                            </div>
                            @if($user->role === 'admin')
                                <div class="task-assignee">
                                    Assigné à: {{ $tache->user->name }}
                                </div>
                            @endif
                        </div>
                        <span class="task-status status-{{ $tache->etat }}">
                            {{ ucfirst($tache->etat) }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>