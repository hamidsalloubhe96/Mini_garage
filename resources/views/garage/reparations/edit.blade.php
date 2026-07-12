@extends('layouts.app')

@section('titre', '— Modifier une réparation')

@section('content')
    <h1 class="mb-4">Modifier la réparation</h1>

    <form method="POST" action="{{ route('reparations.update', $reparation) }}" style="max-width:600px;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Véhicule</label>
            <select name="vehicule_id" class="form-select">
                @foreach($vehicules as $v)
                    <option value="{{ $v->id }}" {{ $reparation->vehicule_id == $v->id ? 'selected' : '' }}>
                        {{ $v->marque }} {{ $v->modele }} — {{ $v->immatriculation }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $reparation->date) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Durée main d'œuvre</label>
            <select name="duree_main_oeuvre" class="form-select">
                @foreach(['1h','2h','3h','4h','8h'] as $d)
                    <option value="{{ $d }}" {{ $reparation->duree_main_oeuvre == $d ? 'selected' : '' }}>{{ $d }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Objet de la réparation</label>
            <textarea name="objet_reparation" class="form-control" rows="3">{{ old('objet_reparation', $reparation->objet_reparation) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Techniciens</label>
            @foreach($techniciens as $tech)
                <div class="form-check">
                    <input type="checkbox" name="techniciens[]" value="{{ $tech->id }}"
                        class="form-check-input" id="tech{{ $tech->id }}"
                        {{ $reparation->techniciens->contains($tech->id) ? 'checked' : '' }}>
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