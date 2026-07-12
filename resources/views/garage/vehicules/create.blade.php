@extends('layouts.app')

@section('titre', '— Ajouter un véhicule')

@section('content')
    <h1 class="mb-4">Ajouter un véhicule</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('vehicules.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Immatriculation</label>
                <input type="text" name="immatriculation" class="form-control" value="{{ old('immatriculation') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Marque</label>
                <input type="text" name="marque" class="form-control" value="{{ old('marque') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Modèle</label>
                <input type="text" name="modele" class="form-control" value="{{ old('modele') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Couleur</label>
                <input type="text" name="couleur" class="form-control" value="{{ old('couleur') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Année</label>
                <input type="number" name="annee" class="form-control" value="{{ old('annee') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Kilométrage</label>
                <input type="number" name="kilometrage" class="form-control" value="{{ old('kilometrage') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Carrosserie</label>
                <select name="carrosserie" class="form-select">
                    @foreach(['Berline','SUV','Break','Coupé','Monospace'] as $c)
                        <option value="{{ $c }}" {{ old('carrosserie') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Énergie</label>
                <select name="energie" class="form-select">
                    @foreach(['Essence','Diesel','Hybride','Électrique'] as $e)
                        <option value="{{ $e }}" {{ old('energie') == $e ? 'selected' : '' }}>{{ $e }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Boîte</label>
                <select name="boite" class="form-select">
                    <option value="Manuelle">Manuelle</option>
                    <option value="Automatique">Automatique</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('vehicules.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
@endsection