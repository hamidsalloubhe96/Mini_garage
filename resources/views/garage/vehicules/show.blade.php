@extends('layouts.app')

@section('titre', '— Détail véhicule')

@section('content')
    <h1 class="mb-3">{{ $vehicule->marque }} {{ $vehicule->modele }}</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Immatriculation :</strong> {{ $vehicule->immatriculation }}</p>
            <p><strong>Couleur :</strong> {{ $vehicule->couleur }}</p>
            <p><strong>Année :</strong> {{ $vehicule->annee }}</p>
            <p><strong>Kilométrage :</strong> {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km</p>
            <p><strong>Carrosserie :</strong> {{ $vehicule->carrosserie }}</p>
            <p><strong>Énergie :</strong> {{ $vehicule->energie }}</p>
            <p><strong>Boîte :</strong> {{ $vehicule->boite }}</p>
        </div>
    </div>

    <h3 class="mt-4">Réparations associées</h3>
    @if($vehicule->reparations->isEmpty())
        <p>Aucune réparation enregistrée.</p>
    @else
        <ul class="list-group">
            @foreach($vehicule->reparations as $rep)
                <li class="list-group-item">
                    {{ $rep->date }} — {{ $rep->objet_reparation }} ({{ $rep->duree_main_oeuvre }})
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-3">
        <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">Retour</a>
        <a href="{{ route('vehicules.edit', $vehicule) }}" class="btn btn-warning">Modifier</a>
    </div>
@endsection