<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::user()->role == 'admin' ? 'Gestion des Tâches' : 'Mes Tâches' }}</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
        }
        .add-task-btn {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-weight: 500;
        }
        .add-task-btn:hover {
            background-color: #2563eb;
        }
        .tasks-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .tasks-table th,
        .tasks-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .tasks-table th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #374151;
        }
        .tasks-table tr:last-child td {
            border-bottom: none;
        }
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .status-a-faire {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        .status-en-cours {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-termine {
            background-color: #d1fae5;
            color: #065f46;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .status-btn {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }
        .status-btn:hover {
            opacity: 0.9;
        }
        .btn-a-faire {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        .btn-en-cours {
            background-color: #fef3c7;
            color: #92400e;
        }
        .btn-termine {
            background-color: #d1fae5;
            color: #065f46;
        }
        .edit-btn {
            background-color: #f59e0b;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-size: 0.875rem;
        }
        .edit-btn:hover {
            background-color: #d97706;
        }
        .delete-btn {
            background-color: #ef4444;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-size: 0.875rem;
        }
        .delete-btn:hover {
            background-color: #dc2626;
        }
        .date-range {
            color: #6b7280;
            font-size: 0.875rem;
        }
        .no-tasks {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <x-navbar role="{{ Auth::user()->role }}"></x-navbar>
    
    <div class="container">
        @if(session('success'))
            <div class="success-message" style="background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif
        <div class="header">
            <h1 class="page-title">{{ Auth::user()->role == 'admin' ? 'Gestion des Tâches' : 'Mes Tâches' }}</h1>
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('taches.create') }}" class="add-task-btn">Ajouter une Tâche</a>
            @endif
        </div>

        @if($taches->isEmpty())
            <div class="no-tasks">
                <p>{{ Auth::user()->role == 'admin' ? 'Aucune tâche créée pour le moment.' : 'Aucune tâche assignée pour le moment.' }}</p>
            </div>
        @else
            <table class="tasks-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Période</th>
                        @if(Auth::user()->role == 'admin')
                            <th>Employé</th>
                        @endif
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taches as $tache)
                        <tr>
                            <td>{{ $tache->titre }}</td>
                            <td>{{ $tache->description }}</td>
                            <td>
                                <div class="date-range">
                                    {{ $tache->dateDebut }} - {{ $tache->datefin }}
                                </div>
                            </td>
                            @if(Auth::user()->role == 'admin')
                                <td>{{ $tache->user->name }}</td>
                            @endif
                            <td>
                                <span class="status-badge status-{{ $tache->etat }}">
                                    @if($tache->etat == 'start')
                                        À faire
                                    @elseif($tache->etat == 'progress')
                                        En cours
                                    @else
                                        Terminé
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if(Auth::user()->role == 'admin')
                                        <a href="{{ route('taches.edit', $tache) }}" class="edit-btn">Modifier</a>
                                        <form action="{{ route('taches.destroy', $tache) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</button>
                                        </form>
                                    @else
                                        <form action="{{ route('taches.update.etat', $tache) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="etat" value="start">
                                            <button type="submit" class="status-btn btn-a-faire" {{ $tache->etat == 'start' ? 'disabled' : '' }}>
                                                À faire
                                            </button>
                                        </form>
                                        <form action="{{ route('taches.update.etat', $tache) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="etat" value="progress">
                                            <button type="submit" class="status-btn btn-en-cours" {{ $tache->etat == 'progress' ? 'disabled' : '' }}>
                                                En cours
                                            </button>
                                        </form>
                                        <form action="{{ route('taches.update.etat', $tache) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="etat" value="dane">
                                            <button type="submit" class="status-btn btn-termine" {{ $tache->etat == 'dane' ? 'disabled' : '' }}>
                                                Terminé
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html> 