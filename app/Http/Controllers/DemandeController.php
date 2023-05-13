<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Demandeur;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function index()
    {

        $demandes = Demande::all();
        // dd($demandes);
        return view('demandes.index', compact('demandes'));
    }

    public function create(){
        return view('demandes.create');
    }


    public function store(Request $request)
    {
        try {
            // Process the request
            // Get the input data from the request
            $demandeurData = $request->input('demandeur');
            $demandeData = $request->input('demande');

            // Check if the demandeur already exists
            $demandeur = Demandeur::firstOrCreate(['CIN' => $demandeurData['CIN']], [
                'Nom' => $demandeurData['Nom'],
                'Prenom' => $demandeurData['Prenom'],
                'birthdate' => $demandeurData['birthdate'],
            ]);

            // Save the uploaded file with a unique filename
            $file = $request->file('demand_files');
            $demandeId = $demandeur->demandes()->max('id') + 1; // get the next ID for the demande
            $date = Carbon::now()->format('YmdHis'); // get the current date and time
            $filename = "{$date}_demande{$demandeId}.{$file->getClientOriginalExtension()}";
            $path = $file->storeAs('demandes', $filename);

            // Create a new demande with the demandeur and the saved file
            $demande = new Demande([
                'status' => 'En attente',
                'demand_files' => $filename,
                'created_by' => Auth::id()
            ]);
            $demandeur->demandes()->save($demande);

            // Store a success message in the session
            session()->flash('success', 'Demande créée avec succès.');

            // Redirect back to the index page with the success message
            return redirect()->route('demande.list');

        } catch (PostTooLargeException $exception) {
            // Handle the exception and return an error response
            return response()->json([
                'error' => 'The file or data you uploaded is too large.'
            ], 400);
        }
    }

    public function view(Demande $demande){
        // dd($demande);
        $demandeur = $demande->demandeur;
        return view('demandes.view', compact('demande','demandeur'));
    }
}
