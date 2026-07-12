<?php

namespace App\Http\Controllers;

use App\Models\Reparation;
use App\Models\Vehicule;
use App\Models\Technicien;
use Illuminate\Http\Request;

class ReparationController extends Controller
{
    public function index()
    {
        $reparations = Reparation::with('vehicule', 'techniciens')->get();
        return view('garage.reparations.index', compact('reparations'));
    }

    public function create()
    {
        $vehicules   = Vehicule::all();
        $techniciens = Technicien::all();
        return view('garage.reparations.create', compact('vehicules', 'techniciens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicule_id'       => 'required',
            'date'              => 'required|date',
            'duree_main_oeuvre' => 'required',
            'objet_reparation'  => 'required',
            'techniciens'       => 'required|array',
        ]);

        $reparation = Reparation::create([
            'vehicule_id'       => $request->vehicule_id,
            'date'              => $request->date,
            'duree_main_oeuvre' => $request->duree_main_oeuvre,
            'objet_reparation'  => $request->objet_reparation,
        ]);

        // Liaison des techniciens (relation plusieurs-à-plusieurs)
        $reparation->techniciens()->sync($request->techniciens);

        return redirect()->route('reparations.index')->with('success', 'Réparation ajoutée.');
    }

    public function show(Reparation $reparation)
    {
        $reparation->load('vehicule', 'techniciens');
        return view('garage.reparations.show', compact('reparation'));
    }

    public function edit(Reparation $reparation)
    {
        $vehicules   = Vehicule::all();
        $techniciens = Technicien::all();
        $reparation->load('techniciens');
        return view('garage.reparations.edit', compact('reparation', 'vehicules', 'techniciens'));
    }

    public function update(Request $request, Reparation $reparation)
    {
        $request->validate([
            'vehicule_id'       => 'required',
            'date'              => 'required|date',
            'duree_main_oeuvre' => 'required',
            'objet_reparation'  => 'required',
        ]);

        $reparation->update([
            'vehicule_id'       => $request->vehicule_id,
            'date'              => $request->date,
            'duree_main_oeuvre' => $request->duree_main_oeuvre,
            'objet_reparation'  => $request->objet_reparation,
        ]);

        if ($request->has('techniciens')) {
            $reparation->techniciens()->sync($request->techniciens);
        } else {
            $reparation->techniciens()->detach();
        }

        return redirect()->route('reparations.index')->with('success', 'Réparation modifiée.');
    }

    public function destroy(Reparation $reparation)
    {
        $reparation->techniciens()->detach();
        $reparation->delete();
        return redirect()->route('reparations.index')->with('success', 'Réparation supprimée.');
    }
}