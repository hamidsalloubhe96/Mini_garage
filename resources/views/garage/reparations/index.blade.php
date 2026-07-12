@extends('layouts.app')

@section('titre', '— Réparations')

@section('content')
    <h1 class="mb-3">Liste des réparations</h1>

    <a href="{{ route('reparations.create') }}" class="btn btn-success mb-3">Ajouter une réparation</a>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Véhicule</th>
                <th>Objet</th>
                <th>Durée</th>
                <th>Techniciens</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reparations as $rep)
                <tr>
                    <td>{{ $rep->date }}</td>
                    <td>{{ $rep->vehicule->marque }} {{ $rep->vehicule->modele }}</td>
                    <td>{{ $rep->objet_reparation }}</td>
                    <td>{{ $rep->duree_main_oeuvre }}</td>
                    <td>
                        @foreach($rep->techniciens as $tech)
                            <span class="badge bg-secondary">{{ $tech->prenom }} {{ $tech->nom }}</span>
                        @endforeach
                    </td>
                    <td style="white-space: nowrap;">
                        <a href="{{ route('reparations.show', $rep) }}" class="btn btn-info btn-sm">Détail</a>
                        <a href="{{ route('reparations.edit', $rep) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form method="POST" action="{{ route('reparations.destroy', $rep) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer cette réparation ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune réparation trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection