<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des demandes') }}
        </h2>
    </x-slot>

<!-- Breadcrumb -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <nav class="flex px-5 py-3 text-gray-700 " aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
              Acceuil
            </a>
          </li>
          {{-- <li>
            <div class="flex items-center">
              <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Templates</a>
            </div>
          </li> --}}
          <li aria-current="page">
            <div class="flex items-center">
              <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Demandes</span>
            </div>
          </li>
        </ol>
      </nav>
</div>


    <div class="my-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-between p-6 mb-4">
                <div class=" text-gray-900 self-center">
                    {{ __("Liste des demandes") }}
                </div>
                <a href="{{route('demande.create')}}" class=" py-2 px-3 bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold rounded-md shadow focus:outline-none" >Nouvelle demande</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full p-4">
                <table id="demandesTable" class="display">
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
                                @if($demande->status === 'Approuvé')
                                <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-green-900 dark:text-green-300"> {{ $demande->status }}</span>
                                @endif
                                @if($demande->status === 'Rejeté')
                                <span class="bg-red-100 text-red-800 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-red-900 dark:text-red-300"> {{ $demande->status }}</span>
                                @endif
                                @if($demande->status === 'Payé/en cours')
                                <span class="bg-blue-100 text-blue-800 font-medium mr-2 px-2.5 py-0.5 rounded-full text-xs dark:bg-blue-900 dark:text-blue-300"> {{ $demande->status }}</span>
                                @endif
                            </td>
                            <td><i class="fa-regular fa-clock mr-2"></i>{{ $demande->created_at }}</td>
                            <td class="flex justify-end">
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                                      </x-slot>
                                      <x-slot name="content">
                                        <x-dropdown-link href="{{route('demande.view',$demande)}}"><i class="fa-regular fa-eye mr-2"></i>Voir</x-dropdown-link>
                                        <x-dropdown-link><i class="fa-regular fa-pen-to-square mr-2"></i>Modifier</x-dropdown-link>
                                        <x-dropdown-link><i class="fa-regular fa-trash-can mr-2"></i>Supprimer</x-dropdown-link>
                                      </x-slot>

                                </x-dropdown>
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
let table = new DataTable('#demandesTable', {
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
