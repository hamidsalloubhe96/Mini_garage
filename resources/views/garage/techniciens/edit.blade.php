@extends('layouts.app')

@section('titre', '— Modifier un technicien')

@section('content')
    <h1 class="mb-4">Modifier : {{ $technicien->prenom }} {{ $technicien->nom }}</h1>

    <form method="POST" action="{{ route('techniciens.update', $technicien) }}" style="max-width:500px;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $technicien->nom) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $technicien->prenom) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Spécialité</label>
            <select name="specialite" class="form-select">
                @foreach(['Moteur','Électricité','Carrosserie','Climatisation','Freinage'] as $s)
                    <option value="{{ $s }}" {{ $technicien->specialite == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('techniciens.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection