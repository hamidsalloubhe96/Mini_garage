@extends('layouts.app')

@section('titre', '— Ajouter un technicien')

@section('content')
    <h1 class="mb-4">Ajouter un technicien</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('techniciens.store') }}" style="max-width:500px;">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Spécialité</label>
            <select name="specialite" class="form-select">
                @foreach(['Moteur','Électricité','Carrosserie','Climatisation','Freinage'] as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('techniciens.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection