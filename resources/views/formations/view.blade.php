<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des formations') }}
        </h2>
    </x-slot>


    <div class="my-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between p-6 mb-4">
                <div class=" text-gray-900 self-center">
                    {{ __("Liste des demandes dans la formation") }}
                </div>

            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full p-4">
                <table id="FormationDemandesTable" class="display">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nom</td>
                            <td>Prenom</td>
                            <td>CIN</td>
                            <td>Statut</td>
                            <td>Crée le</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                        <tr>
                            <td>{{ $demande->id }}</td>
                            <td>{{ $demande->demandeur->Nom }}</td>
                            <td>{{ $demande->demandeur->Prenom }}</td>
                            <td>{{ $demande->demandeur->CIN}}</td>
                            <td>
                                @if($demande->status === 'En attente')
                                <span class="bg-gray-100 text-gray-800 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-gray-700 dark:text-gray-300"> {{ $demande->status }}</span>
                                @endif

                                @if($demande->status === 'Acceptée')
                                <span class="bg-cyan-100 text-cyan-900 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-gray-700 dark:text-gray-300"> {{ $demande->status }}</span>
                                @endif
                                @if($demande->status === 'Rejetée')
                                <span class="bg-red-100 text-red-800 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-red-900 dark:text-red-300"> {{ $demande->status }}</span>
                                @endif
                                @if($demande->status === 'En formation')
                                <span class="bg-amber-100 text-amber-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-green-900 dark:text-green-300"> {{ $demande->status }}</span>
                                @endif
                                @if($demande->status === 'Payée')
                                <span class="bg-blue-100 text-blue-800 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-blue-900 dark:text-blue-300"> {{ $demande->status }}</span>
                                @endif
                                @if($demande->status === 'Admis')
                                <span class="bg-blue-100 text-blue-800 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-blue-900 dark:text-blue-300"> {{ $demande->status }}</span>
                                @endif
                                @if($demande->status === 'Non admis')
                                <span class="bg-red-100 text-red-800 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-red-900 dark:text-red-300"> {{ $demande->status }}</span>
                                @endif
                                @if($demande->status === 'Recuperé')
                                <span class="bg-cyan-100 text-cyan-900 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-gray-700 dark:text-gray-300"> {{ $demande->status }}</span>
                                @endif
                            </td>
                            <td><i class="fa-regular fa-clock mr-2"></i>{{ $demande->created_at }}</td>
                            <td class="flex justify-end">
                                @if($demande->status != 'Recuperé')
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                                    </x-slot>
                                    <x-slot name="content">
                                        <form action="{{route('demande.admis',$demande)}}" method="POST">
                                            @csrf
                                            <button class="w-full pb-1" type="submit"><i class="fa-solid fa-check mr-2"></i>Admis</button>
                                        </form>
                                        <form action="{{route('demande.non_admis',$demande)}}" method="POST">
                                            @csrf
                                            <button class="w-full border-t pt-1" type="submit"><i class="fa-solid fa-xmark mr-2"></i>Non admis</button>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>



            </div>
        </div>
    </div>
</x-app-layout>

<script>
let table = new DataTable('#FormationDemandesTable', {
    responsive: true,
    fixedHeader: true,
    "language": {
        "sEmptyTable":    "Aucune donnée disponible dans le tableau",
        "sInfo":          "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
        "sInfoEmpty":     "Affichage de l'élément 0 à 0 sur 0 élément",
        "sInfoFiltered":  "(filtré à partir de _MAX_ éléments au total)",
        "sInfoPostFix":   "",
        "sInfoThousands": ",",
        "sLengthMenu":    "Afficher _MENU_ éléments",
        "sLoadingRecords": "Chargement...",
        "sProcessing":    "Traitement...",
        "sSearch":        "Rechercher : ",
        "sZeroRecords":   "Aucun élément correspondant trouvé",
        "oPaginate": {
            "sFirst":    "Premier",
            "sLast":     "Dernier",
            "sNext":     "Suivant",
            "sPrevious": "Précédent"
        },
        "oAria": {
            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
            "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
        }
    }
});
</script>
