<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicule::query();

        // Recherche par marque ou immatriculation
        if ($request->filled('recherche')) {
            $query->where('marque', 'like', '%' . $request->recherche . '%')
                  ->orWhere('immatriculation', 'like', '%' . $request->recherche . '%');
        }

        $vehicules = $query->get();
        return view('garage.vehicules.index', compact('vehicules'));
    }

    public function create()
    {
        return view('garage.vehicules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'immatriculation' => 'required|unique:vehicules',
            'marque'          => 'required',
            'modele'          => 'required',
            'couleur'         => 'required',
            'annee'           => 'required|integer',
            'kilometrage'     => 'required|integer',
            'carrosserie'     => 'required',
            'energie'         => 'required',
            'boite'           => 'required',
        ]);

        Vehicule::create($request->all());
        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté.');
    }

    public function show(Vehicule $vehicule)
    {
        return view('garage.vehicules.show', compact('vehicule'));
    }

    public function edit(Vehicule $vehicule)
    {
        return view('garage.vehicules.edit', compact('vehicule'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $request->validate([
            'marque'      => 'required',
            'modele'      => 'required',
            'couleur'     => 'required',
            'annee'       => 'required|integer',
            'kilometrage' => 'required|integer',
            'carrosserie' => 'required',
            'energie'     => 'required',
            'boite'       => 'required',
        ]);

        $vehicule->update($request->all());
        return redirect()->route('vehicules.index')->with('success', 'Véhicule modifié.');
    }

    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé.');
    }
}