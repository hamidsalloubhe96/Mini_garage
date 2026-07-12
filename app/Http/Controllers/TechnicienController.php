<?php

namespace App\Http\Controllers;

use App\Models\Technicien;
use Illuminate\Http\Request;

class TechnicienController extends Controller
{
    public function index()
    {
        $techniciens = Technicien::all();
        return view('garage.techniciens.index', compact('techniciens'));
    }

    public function create()
    {
        return view('garage.techniciens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'        => 'required',
            'prenom'     => 'required',
            'specialite' => 'required',
        ]);

        Technicien::create($request->all());
        return redirect()->route('techniciens.index')->with('success', 'Technicien ajouté.');
    }

    public function show(Technicien $technicien)
    {
        return view('garage.techniciens.show', compact('technicien'));
    }

    public function edit(Technicien $technicien)
    {
        return view('garage.techniciens.edit', compact('technicien'));
    }

    public function update(Request $request, Technicien $technicien)
    {
        $request->validate([
            'nom'        => 'required',
            'prenom'     => 'required',
            'specialite' => 'required',
        ]);

        $technicien->update($request->all());
        return redirect()->route('techniciens.index')->with('success', 'Technicien modifié.');
    }

    public function destroy(Technicien $technicien)
    {
        $technicien->delete();
        return redirect()->route('techniciens.index')->with('success', 'Technicien supprimé.');
    }
}