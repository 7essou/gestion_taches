<style>
    .navbar {
        background-color: #2563eb;
        margin: 10px;
        color: white;
        padding: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .nav-links {
        display: flex;
        gap: 1.5rem;
    }
    .nav-link {
        color: white;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        transition: background-color 0.3s ease;
    }
    .nav-link:hover {
        background-color: #1d4ed8; 
    }
    .logout-btn {
        background-color: #4b5563; 
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .logout-btn:hover {
        background-color: #374151; 
    }

    /* Mobile Styles */
    @media (max-width: 640px) {
        .navbar {
            padding: 0.75rem;
        }
        .navbar-container {
            flex-direction: column;
            align-items: flex-start;
        }
        .nav-links {
            flex-direction: column;
            width: 100%;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .nav-link {
            width: 100%;
            text-align: left;
            padding: 0.75rem 1rem;
        }
    }
</style>

<nav class="navbar">
    <div class="navbar-container">
        <div class="nav-links">
            <a href="{{ route('home') }}" class="nav-link">Accueil</a>
            @if($role == 'admin')
                <a href="{{ route('taches.index') }}" class="nav-link">Tâches</a>
                <a href="{{ route('employes.index') }}" class="nav-link">Employés</a>
            @else
                <a href="{{ route('taches.index') }}" class="nav-link">Travail</a>
            @endif
            <a href="{{ route('user.edit') }}" class="nav-link">Mon compte</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Déconnexion</button>
            </form>
        </div>
    </div>
</nav>