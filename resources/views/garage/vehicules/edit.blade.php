@extends('layouts.app')

@section('titre', '— Modifier un véhicule')

@section('content')
    <h1 class="mb-4">Modifier : {{ $vehicule->marque }} {{ $vehicule->modele }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('vehicules.update', $vehicule) }}">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Immatriculation</label>
                <input type="text" name="immatriculation" class="form-control" value="{{ old('immatriculation', $vehicule->immatriculation) }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Marque</label>
                <input type="text" name="marque" class="form-control" value="{{ old('marque', $vehicule->marque) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Modèle</label>
                <input type="text" name="modele" class="form-control" value="{{ old('modele', $vehicule->modele) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Couleur</label>
                <input type="text" name="couleur" class="form-control" value="{{ old('couleur', $vehicule->couleur) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Année</label>
                <input type="number" name="annee" class="form-control" value="{{ old('annee', $vehicule->annee) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Kilométrage</label>
                <input type="number" name="kilometrage" class="form-control" value="{{ old('kilometrage', $vehicule->kilometrage) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Carrosserie</label>
                <select name="carrosserie" class="form-select">
                    @foreach(['Berline','SUV','Break','Coupé','Monospace'] as $c)
                        <option value="{{ $c }}" {{ old('carrosserie', $vehicule->carrosserie) == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Énergie</label>
                <select name="energie" class="form-select">
                    @foreach(['Essence','Diesel','Hybride','Électrique'] as $e)
                        <option value="{{ $e }}" {{ old('energie', $vehicule->energie) == $e ? 'selected' : '' }}>{{ $e }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Boîte</label>
                <select name="boite" class="form-select">
                    <option value="Manuelle" {{ $vehicule->boite == 'Manuelle' ? 'selected' : '' }}>Manuelle</option>
                    <option value="Automatique" {{ $vehicule->boite == 'Automatique' ? 'selected' : '' }}>Automatique</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
@endsection