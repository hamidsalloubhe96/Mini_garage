<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garage @yield('titre')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="{{ route('vehicules.index') }}">🔧 Garage</a>
                <div class="navbar-nav">
                    <a class="nav-link {{ request()->routeIs('vehicules.*') ? 'active' : '' }}"
                        href="{{ route('vehicules.index') }}">Véhicules</a>
                    <a class="nav-link {{ request()->routeIs('reparations.*') ? 'active' : '' }}"
                        href="{{ route('reparations.index') }}">Réparations</a>
                    <a class="nav-link {{ request()->routeIs('techniciens.*') ? 'active' : '' }}"
                        href="{{ route('techniciens.index') }}">Techniciens</a>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                {{-- Utilisateur connecté --}}
                <span class="text-white">
                    👤 {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

</body>

</html>