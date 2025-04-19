<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Employés</title>
    <style>
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
        .add-employe-btn {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-weight: 500;
        }
        .add-employe-btn:hover {
            background-color: #2563eb;
        }
        .employees-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .employees-table th,
        .employees-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .employees-table th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #374151;
        }
        .employees-table tr:last-child td {
            border-bottom: none;
        }
        .role-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .role-admin {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .role-employer {
            background-color: #d1fae5;
            color: #065f46;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
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
    </style>
</head>
<body>
    <x-navbar role="{{ Auth::user()->role }}"></x-navbar>
    
    <div class="container">
        <div class="header">
            <h1>Gestion des Employés</h1>
            <a href="{{ route('employes.create') }}" class="add-employe-btn">Ajouter un Employé</a>
        </div>

        <table class="employees-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employes as $employe)
                    <tr>
                        <td>{{ $employe->name }}</td>
                        <td>{{ $employe->email }}</td>
                        <td>
                            <span class="role-badge role-{{ $employe->role }}">
                                {{ ucfirst($employe->role) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('employes.edit', $employe) }}" class="edit-btn">Modifier</a>
                                <form action="{{ route('employes.destroy', $employe) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> 