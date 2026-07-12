@extends('layouts.app')

@section('titre', '— Détail réparation')

@section('content')
    <h1 class="mb-3">Détail de la réparation</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Date :</strong> {{ $reparation->date }}</p>
            <p><strong>Véhicule :</strong> {{ $reparation->vehicule->marque }} {{ $reparation->vehicule->modele }} ({{ $reparation->vehicule->immatriculation }})</p>
            <p><strong>Objet :</strong> {{ $reparation->objet_reparation }}</p>
            <p><strong>Durée main d'œuvre :</strong> {{ $reparation->duree_main_oeuvre }}</p>
            <p><strong>Techniciens :</strong>
                @foreach($reparation->techniciens as $tech)
                    <span class="badge bg-dark">{{ $tech->prenom }} {{ $tech->nom }} — {{ $tech->specialite }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <a href="{{ route('reparations.index') }}" class="btn btn-secondary">Retour</a>
    <a href="{{ route('reparations.edit', $reparation) }}" class="btn btn-warning">Modifier</a>
@endsection