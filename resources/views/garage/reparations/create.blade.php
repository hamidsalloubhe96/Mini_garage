@extends('layouts.app')

@section('titre', '— Ajouter une réparation')

@section('content')
    <h1 class="mb-4">Ajouter une réparation</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reparations.store') }}" style="max-width:600px;">
        @csrf
        <div class="mb-3">
            <label class="form-label">Véhicule</label>
            <select name="vehicule_id" class="form-select">
                @foreach($vehicules as $v)
                    <option value="{{ $v->id }}">{{ $v->marque }} {{ $v->modele }} — {{ $v->immatriculation }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Durée main d'œuvre</label>
            <select name="duree_main_oeuvre" class="form-select">
                @foreach(['1h','2h','3h','4h','8h'] as $d)
                    <option value="{{ $d }}">{{ $d }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Objet de la réparation</label>
            <textarea name="objet_reparation" class="form-control" rows="3">{{ old('objet_reparation') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Techniciens (sélection multiple)</label>
            @foreach($techniciens as $tech)
                <div class="form-check">
                    <input type="checkbox" name="techniciens[]" value="{{ $tech->id }}"
                        class="form-check-input" id="tech{{ $tech->id }}">
                    <label class="form-check-label" for="tech{{ $tech->id }}">
                        {{ $tech->prenom }} {{ $tech->nom }} — {{ $tech->specialite }}
                    </label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('reparations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection