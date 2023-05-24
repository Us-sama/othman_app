<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Demandeur;
use App\Models\Formation;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
                $demandeur = Demandeur::where('CIN', $demandeurData['CIN'])->first();

                if ($demandeur) {
                    // Return a message indicating that the CIN already exists
                    session()->flash('error', 'Le demandeur avec le CIN fourni existe déjà.');
                    return redirect()->back();
                }

                // If the demandeur doesn't exist, create a new one
                $demandeur = Demandeur::create([
                    'CIN' => $demandeurData['CIN'],
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
            session()->flash('success', 'Demande crée avec succès.');

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
        $formations = Formation::all();
        return view('demandes.view', compact('demande','demandeur','formations'));
    }
    public function accepter($demande){
        $demande = Demande::findOrFail($demande);

        $demande->status = 'Acceptée';
        $demande->save();

         return redirect()->back()->with('success', 'Demande a bien été acceptée. ');
    }
    public function rejeter($demande){
        $demande = Demande::findOrFail($demande);

        $demande->status = 'Rejetée';
        $demande->save();

         return redirect()->back()->with('success', 'Demande a bien été refusée. ');
    }
    public function admis($demande){
        $demande = Demande::findOrFail($demande);

        $demande->status = 'Admis';
        $demande->save();

         return redirect()->back()->with('success', 'Demande a bien été admis. ');
    }
    public function nonAdmis($demande){
        $demande = Demande::findOrFail($demande);

        $demande->status = 'Non admis';
        $demande->save();

         return redirect()->back()->with('success', 'Demande non admis. ');
    }
    public function recupere($demande){
        $demande = Demande::findOrFail($demande);

        $demande->status = 'Recuperé';
        $demande->save();

         return redirect()->route('demande.list')->with('success', 'Permis est bien recuperé. ');
    }

    public function storePaymentFile(Request $request, $demande)
    {
        $demande = Demande::findOrFail($demande);

        $file = $request->file('payment_file');
        $date = now()->format('YmdHis');
        $filename = "{$date}_payment_{$file->getClientOriginalName()}";
        $path = $file->storeAs('demandes/' . $filename);

        $demande->status = 'Payée';
        $demande->payment_file = $filename;
        $demande->save();

        return redirect()->back()->with('success', 'Payment file has been uploaded successfully.');
    }

    public function attachFormation(Request $request, $demande){
        $demande = Demande::findOrFail($demande);
        $demande->status = 'En formation';
        $formation = Formation::findOrFail($request->input('formation'));
        $formation->demandes()->save($demande);
        $demande->save();

        return redirect()->back()->with('success','demande attaché à la formation');

    }

    public function downloadFile($filename)
    {
        $path = 'demandes/' . $filename; // Replace with the path to your file in the storage
        $headers = [
            'Content-Type' => Storage::mimeType($path),
        ];
        return Storage::download($path, $filename, $headers);
    }


    public function destroy($demande)
    {
        // Assuming that $demande is a string containing the demand's ID
        $demande_to_delete = Demande::findOrFail($demande);
        Storage::delete('demandes/' . $demande_to_delete->demand_files); // delete the demand file from storage
        $demande_to_delete->delete(); // delete the demand from the database
        return redirect()->route('demande.list')->with('success', 'Demande supprimée avec succès.');
    }
}
