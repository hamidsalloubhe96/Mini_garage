@extends('layouts.app')

@section('titre', '— Véhicules')

@section('content')
    <h1 class="mb-3">Liste des véhicules</h1>

    <form method="GET" action="{{ route('vehicules.index') }}" class="d-flex mb-3 gap-2">
        <input type="text" name="recherche" class="form-control" placeholder="Rechercher par marque ou immatriculation" value="{{ request('recherche') }}">
        <button type="submit" class="btn btn-primary">Rechercher</button>
        <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">Réinitialiser</a>
    </form>

    <a href="{{ route('vehicules.create') }}" class="btn btn-success mb-3">Ajouter un véhicule</a>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Immatriculation</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Année</th>
                <th>Énergie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicules as $vehicule)
            <tr>
                <td>{{ $vehicule->immatriculation }}</td>
                <td>{{ $vehicule->marque }}</td>
                <td>{{ $vehicule->modele }}</td>
                <td>{{ $vehicule->annee }}</td>
                <td>{{ $vehicule->energie }}</td>
                <td>
                    <a href="{{ route('vehicules.show', $vehicule) }}" class="btn btn-info btn-sm">Détail</a>
                    <a href="{{ route('vehicules.edit', $vehicule) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('vehicules.destroy', $vehicule) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer ce véhicule ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr><td colspan="6" class="text-center">Aucun véhicule trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection