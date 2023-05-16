<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des formations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-between">
                    {{ __("Liste des formation") }}

                    <x-primary-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-formation-modal')"
                        class="my-2"
                    > <i class="fa-regular fa-credit-card mr-2"></i>{{ __('Ajouter une formation') }}</x-primary-button>
                </div>
            </div>
            <x-modal name="create-formation-modal" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <form method="POST" action="{{route('formation.store')}}" class="p-6">
                    @csrf

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Ajouter une formation.') }}
                    </h2>

                    <div class="mt-6">
                        <div class="mb-6">
                            <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                            <input required type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-6">

                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea required id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ajouter une description pour la formation"></textarea>

                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ml-3" type="submit">
                            {{ __('Ajouter la formation') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>




            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full p-4 mt-4">

                <ul class=" max-w-2xl divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($formations as $formation)
                    <li class="pb-3 sm:pb-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{$formation->name}}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{$formation->description}}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <span class="mx-2 font-bold text-purple-800">
                                    {{$formation->demandes()->count()}}
                                </span>
                                Demande(s)
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>



            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full p-4 mt-4">
                <table id="usersTable" class="display">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nom</td>
                            <td>Email</td>
                            <td>Crée le</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->roles->first()->name == 'chef')

                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-purple-400 border border-purple-400">{{ $user->roles->first()->name }}</span>
                                @endif
                                @if($user->roles->first()->name == 'admin')

                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">{{ $user->roles->first()->name }}</span>
                                @endif
                                @if($user->roles->first()->name == 'agent')

                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">{{ $user->roles->first()->name }}</span>
                                @endif
                            </td>

                            <td><i class="fa-regular fa-clock mr-2"></i>{{ $user->created_at }}</td>
                            <td class="flex justify-end">
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <i class="fa-solid fa-ellipsis-vertical cursor-pointer"></i>
                                      </x-slot>
                                      <x-slot name="content">
                                        <x-dropdown-link><i class="fa-regular fa-pen-to-square mr-2"></i>Modifier</x-dropdown-link>
                                        <x-dropdown-link><i class="fa-regular fa-trash-can mr-2"></i>Supprimer</x-dropdown-link>
                                      </x-slot>

                                </x-dropdown>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div> --}}
        </div>
    </div>

</x-app-layout>
{{-- <script>
    let table = new DataTable('#usersTable', {
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
    </script> --}}
