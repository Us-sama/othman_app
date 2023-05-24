<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $formationNames = Formation::orderBy('created_at')->pluck('name')->toArray();
        $jsonFormationNames = json_encode($formationNames);

        $formations = Formation::orderBy('created_at')->get();
        $formationDemandes = [];

        foreach ($formations as $formation) {
            $formationDemandes[] = $formation->demandeCount();
        }

        $demandeCount =  json_encode($formationDemandes);


        //doghnuts chart
        $statusCounts = Demande::groupBy('status')
        ->select('status', DB::raw('count(*) as count'))
        ->get();

       // Prepare the data for the chart
        $labels = $statusCounts->pluck('status');
        $data = $statusCounts->pluck('count');
        $backgroundColor = [
            '#f5d9a8',
            '#ff6384',
            '#F5A9A9',
            '#42cba5',
            '#292961',
            '#7c3aed',
            '#a3e635',
            '#36a2eb',

        ];

        // Encode the data as JSON
        $labelsJson = json_encode($labels);
        $dataJson = json_encode($data);
        $backgroundColorJson = json_encode($backgroundColor);


        return view('dashboard', compact('jsonFormationNames','demandeCount','labelsJson','dataJson','backgroundColorJson' ));
    }
}
