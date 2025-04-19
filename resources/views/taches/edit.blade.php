<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Tâche</title>
    <style>
        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        .form-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        .form-textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            min-height: 100px;
            resize: vertical;
        }
        .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        .form-select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            background-color: white;
        }
        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
        .btn-secondary {
            background-color: #e5e7eb;
            color: #374151;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #d1d5db;
        }
    </style>
</head>
<body>
    <x-navbar role="{{ Auth::user()->role }}"></x-navbar>
    
    <div class="container">
        <div class="form-container">
            <h1>Modifier la Tâche</h1>
            
            <form action="{{ route('taches.update', $tache) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" id="titre" name="titre" class="form-input" value="{{ old('titre', $tache->titre) }}" required>
                    @error('titre')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-textarea">{{ old('description', $tache->description) }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="dateDebut" class="form-label">Date de début</label>
                    <input type="date" id="dateDebut" name="dateDebut" class="form-input" value="{{ old('dateDebut', $tache->dateDebut) }}" required>
                    @error('dateDebut')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="datefin" class="form-label">Date de fin</label>
                    <input type="date" id="datefin" name="datefin" class="form-input" value="{{ old('datefin', $tache->datefin) }}" required>
                    @error('datefin')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                @if(Auth::user()->role == 'admin')
                <div class="form-group">
                    <label for="user_id" class="form-label">Employé assigné</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="">Sélectionner un employé</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $tache->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                @endif
                
                <div class="btn-group">
                    <a href="{{ route('taches.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 