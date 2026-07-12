@extends('layouts.app')

@section('titre', '— Techniciens')

@section('content')
    <h1 class="mb-3">Liste des techniciens</h1>

    <a href="{{ route('techniciens.create') }}" class="btn btn-success mb-3">Ajouter un technicien</a>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Spécialité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($techniciens as $technicien)
            <tr>
                <td>{{ $technicien->nom }}</td>
                <td>{{ $technicien->prenom }}</td>
                <td>{{ $technicien->specialite }}</td>
                <td>
                    <a href="{{ route('techniciens.edit', $technicien) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('techniciens.destroy', $technicien) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Supprimer ce technicien ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr><td colspan="4" class="text-center">Aucun technicien trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection