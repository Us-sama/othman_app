<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index(){
        $formations = Formation::all();
        return view('formations.index', compact('formations'));
    }

    public function store(Request $request){

        $formation = new Formation();

        $formation->name = $request->input('name');
        $formation->description = $request->input('description');

        $formation->save();

        return redirect()->route('formation.list')->with('success','Formation crée avec success');
    }
    public function destroy($formation){
        $formation = Formation::findOrFail($formation);
        if ($formation->demandes()->count() > 0) {
            return redirect()->back()->with('alert','la formation contient des demandes!! impossible de la supprimer');
        }else{
            $formation->delete();
            return redirect()->back()->with('success', 'la formation est supprimé');
        }
    }

    public function view($formation){
        $formation = Formation::findOrFail($formation);
        $demandes = $formation->demandes;
        return view('formations.view' , compact('formation', 'demandes'));
    }
}
